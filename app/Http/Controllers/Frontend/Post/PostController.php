<?php

namespace App\Http\Controllers\Frontend\Post;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PusherController;
use App\Lib\PusherFactory;
use App\Models\BudgetType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Category;
use App\Models\CategorySkill;
use App\Models\FlexibleTime;
use App\Models\Post;
use App\Models\AcceptOffer;
use App\Models\PostImage;
use App\Models\PostSkill;
use App\Models\UserSkill;
use App\Models\Notification;
use App\Events\NotificationEvent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Toastr;
use Carbon\Carbon;


class PostController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id',0)->where('status','active')->get();
        $flexibles = FlexibleTime::all();
        $bugets = BudgetType::all();
        if (Auth::check()) {
            return view('frontend.posts.post-task', ['categories' => $categories, 'flexibles' => $flexibles, 'bugets' => $bugets]);
        } else {
            Toastr::success('Please Login Before create any post', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('auth.login.showform');
        }
    }

    public function getSkills(Request $request)
    {
        $skills = CategorySkill::where('category_id', $request->category_id)->get();
        $option = '';
        if(count($skills) > 0){
            foreach ($skills as $list){
                $option .= '<option value="'.$list['id'].'">'.$list['name'].'</option>';
            }
        }
        if (!is_null($request->post_id)) {
            $userSkills = PostSkill::where('post_id', $request->post_id)->get()->pluck('skill_id');
        } else {
            $userSkills = UserSkill::where('user_id', $request->user_id)->get()->pluck('skill_id');
        }
        // $userSkill = [];
        // foreach ($userSkills as $skill) {
        //     $userSkill[] = $skill->skill_id;
        // }
        return response()->json(['success' => true, 'skills' => $skills, 'option'=>$option, 'userSkills' => $userSkills]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $validation = Validator::make($request->all(), [
                'name'          => 'required',
               /* 'address'       => 'required',*/
                'category'      => 'required|not_in:0',
                'sub_category'      => 'required|not_in:0',
                /*'date'          => 'required_without:is_flexible',
                'before_date'   => 'required_without:is_flexible',
                'is_flexible'   => 'required_without:date',
                'certain_time'  => 'required_with:is_flexible,1',
                'flexible.*'    => 'required_with:certain_time,1',*/
                'description'   => 'required',
                //'budget'        => 'required|not_in:0',
                //'amount'        => 'required',
                //'skills'      => 'required_if:category,not_in:0',
                //'images'      => 'required'
                //'images.*'    => 'mimes:jpeg,jpg,png,gif'
            ]);

            if ($validation->fails()) {
                Toastr::error('Some Fields are missing', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withErrors($validation)->withInput();
            }
            $data = [];

            if (isset($request->is_flexible) && !is_null($request->is_flexible)) {
                $data['is_flexible'] = true;
                if ($request->is_flexible == true) {
                    $data['certain_time'] = isset($request->certain_time) ? true : false;
                    $data['flexible_time_id'] = implode(',', $request->flexible);
                }
            } else {
                $data['date'] = $request->date;
                $data['beforedate'] = $request->before_date;
            }

            $budget = BudgetType::where('name',$request['budget'])->first();
            if(empty($budget)){
                $newBudget = new BudgetType();
                $newBudget->name = $request['budget'];
                $newBudget->save();
                $bdId = $newBudget['id'];
            }else{
                $bdId = $budget['id'];
            }

            if($request['amount'] != 'custom'){
                $mainAmt = $request['amount'];
            }else{
                $minAmt = intval($request['minimum']);
                $maxAmt = intval($request['maximum']);
                if($minAmt > 0 && $maxAmt <= 0){
                    $mainAmt = $minAmt.'$';
                }
                if($minAmt <= 0 && $maxAmt > 0){
                    $mainAmt = $maxAmt.'$';
                }
                if($minAmt > 0 && $maxAmt > 0){
                    $mainAmt = $minAmt .'~'. $maxAmt.'$';
                }
            }

            $data['name'] = $request->name;
            $data['category_id'] = $request->category;
            $data['subcategory_id'] = $request->sub_category;
            $data['budget_id'] =  $bdId;
            //$data['budget_id'] =  $request->budget;
            //$data['address'] = $request->address;
            //$data['latitude'] = $request->latitude;
            //$data['longitude'] = $request->longitude;
            $data['description'] = $request->description;
            $data['amount'] = $mainAmt;
            $data['status'] = 'active';
            $data['user_id'] = auth()->user()->id;

            $post = Post::create($data);

            if ($request->hasFile('images')) {
                $imageNames = multipleUploadImage($request->file('images'), storage_path('app/public/uploads/posts/post_images/'));
                foreach ($imageNames as $img) {
                    $postImage = PostImage::create(['post_id' => $post->id, 'image' => $img]);
                }
            }
            foreach ($request->skills as $skill) {
                PostSkill::create(['post_id' => $post->id, 'skill_id' => $skill]);
            }

            if ($post) {
                // $notification_data = [];
                // $notification_data['post_id'] = $post->id;
                // $notification_data['from_user'] = auth()->user()->id;
                // $notification_data['content'] = $post->name;
                // $notification = Notification::create($notification_data);
                // if ($request->hasfile('images')) {
                //     $notification_data['post_image'] = $postImage->getPostImagesAttribute();
                // }
                // $notification_data['from_user_name'] = auth()->user()->name;
                // $notification_data['post_date'] = $notification->date_time_str;

                // //send notificatioin
                $pusherController = new PusherController();
                // $pusherController->notify($notification_data);

                $matched_users = UserSkill::where('user_id', '!=', auth()->user()->id)->whereIn('skill_id', $request->skills)->get();
                foreach ($matched_users as $matched_user) {
                    $nofification_match = [];
                    $nofification_match['post_id'] = $post->id;
                    $nofification_match['from_user'] = auth()->user()->id;
                    $nofification_match['content'] = "There is a job matching your skill. Click here to see more.";
                    $nofification_match['to'] = $matched_user->user_id;
                    $nofification_match['type'] = 1;
                    $notification = Notification::create($nofification_match);
                    if ($request->hasfile('images')) {
                        $nofification_match['post_image'] = $postImage->getPostImagesAttribute();
                    }
                    $nofification_match['from_user_name'] = auth()->user()->name;
                    $nofification_match['post_date'] = $notification->date_time_str;
                    $pusherController->notify($nofification_match);
                }


                //
                Toastr::success('Your job uploaded successfully.', 'Success', ["positionClass" => "toast-top-right"]);
                return redirect()->route('jobs.index');
            } else {
                Toastr::error('Oops! Something went wrong. Please try again', 'Error', ["positionClass" => "toast-top-right"]);
                return back();
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $categories = Category::all();
        $flexibles = FlexibleTime::all();
        $bugets = BudgetType::all();
        $post = Post::where('status', 'active')->where('id', $id)->with('getJobPoster', 'getPostImages', 'getBudgetTypes', 'getPostSkills')->first();

        return view('frontend.posts.edit-post-task', ['post' => $post, 'categories' => $categories, 'flexibles' => $flexibles, 'bugets' => $bugets]);
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $validation = Validator::make($request->all(), [
                'name'          => 'required',
               /* 'address'       => 'required',*/
                'category'      => 'required|not_in:0',
                /*'date'          => 'required_without:is_flexible',
                'before_date'   => 'required_without:is_flexible',
                'is_flexible'   => 'required_without:date',
                'certain_time'  => 'required_with:is_flexible,1',
                'flexible.*'    => 'required_with:certain_time,1',*/
                'description'   => 'required',
                //'budget'        => 'required|not_in:0',
                //'amount'        => 'required',
                //'skills.*'      => 'required_with:category,not_in:0',
                //'images.*'      => 'required|mimes:jpeg,jpg,png'
            ]);

            if ($validation->fails()) {
                Toastr::error('Oops! Some fileds are missing', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withErrors($validation)->withInput();
            }

            $data = [];

            if (isset($request->is_flexible) && !is_null($request->is_flexible)) {
                $data['is_flexible'] = true;
                if ($request->is_flexible == true) {
                    $data['certain_time'] = isset($request->certain_time) ? true : false;
                    $data['flexible_time_id'] = implode(',', $request->flexible);
                }
            } else {
                $data['date'] = $request->date;
                $data['beforedate'] = $request->before_date;
            }

            $data['name'] = $request->name;
            $data['category_id'] = $request->category;
            $data['budget_id'] = $request->budget;
            $data['address'] = $request->address;
            $data['latitude'] = $request->latitude;
            $data['longitude'] = $request->longitude;
            $data['description'] = $request->description;
            $data['amount'] = $request->amount;
            $data['status'] = 'active';
            $data['user_id'] = auth()->user()->id;

            $post = Post::where('id', $id)->update($data);

            if ($request->hasfile('images')) {
                if (PostImage::where('post_id', $post->id)->exists()) {
                    PostImage::where('post_id', $post->id)->delete();
                }

                $imageNames = multipleUploadImage($request->file('images'), storage_path('app/public/uploads/posts/post_images/'));
                foreach ($imageNames as $img) {
                    PostImage::create(['post_id' => $post->id, 'image' => $img]);
                }
            }

            if ($post) {
                if (PostSkill::where('post_id', $post->id)->exists()) {
                    PostSkill::where('post_id', $post->id)->delete();
                }
                foreach ($request->skills as $skill) {
                    PostSkill::create(['post_id' => $post->id, 'skill_id' => $skill]);
                }
                Toastr::success('Post added Successfully', 'Success', ["positionClass" => "toast-top-right"]);
                return redirect()->route('jobs.index');
            } else {
                Toastr::error('Oops! Something went wrong. Please try again', 'Error', ["positionClass" => "toast-top-right"]);
                return back();
            }
        }
    }

    public function update_pstatus(Request $request) {
        $pid = $request->post_id;
        $p_status = $request->pstatus;
        $to_user_id = $request->touserid;
        $post = Post::where("id", $pid)->first();

        if($p_status == 0) {
            if (AcceptOffer::where('user_id', $to_user_id)->where('post_id', $pid)->where('post_user_id', $post->user_id)->where('status', "active")->exists()) {
                return response()->json(['success' => false, 'message' => 'Already offer accepted']);
            } else {
                AcceptOffer::create([
                    "user_id" => $to_user_id,
                    "post_id" => $pid,
                    "post_user_id" => $pid,
                    "status" => "active"
                ]);
            }
        }
        $data = [];
        if($p_status == 0)
            $data["status"] = "awarded";
        if($p_status == 1)
            $data["status"] = "progress";
        else if($p_status == 2)
            $data["status"] = "done";
        Post::where('id', $pid)->update($data);

        $pusherController = new PusherController();
        $nofification_data = [];
        $nofification_data['post_id'] = $pid;
        $nofification_data['from_user'] = auth()->user()->id;
        if($p_status == 0)
            $nofification_data['content'] = "The project(".$post->content.") is awared to you. Please check it.";
        if($p_status == 1)
            $nofification_data['content'] = "The project(".$post->content.") is accepted and in progress.";
        else if($p_status == 2)
            $nofification_data['content'] = "The project(".$post->content.") is completed. Please check it.";
        $nofification_data['to'] = $to_user_id;
        $nofification_data['type'] = 1;
        $notification = Notification::create($nofification_data);
        $nofification_data['from_user_name'] = auth()->user()->name;
        $nofification_data['post_date'] = $notification->date_time_str;
        $pusherController->notify($nofification_data);

        return response()->json(['state' => 1]);
    }

    public function destory($id)
    {
        if (Post::where('id', $id)->exists()) {
            PostSkill::where('post_id', $id)->delete();
            PostImage::where('post_id', $id)->delete();

            Toastr::success('Post deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('jobs.index');
        } else {
            Toastr::error('Oops! Something went wrong. Please try again', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function addCategory(Request $request){
        $data['allCategories'] = Category::where('parent_id',0)->where('status','active')->get();

        $category = $request['category'];
        $sub_category = $request['sub_category'];

        if(!empty($category)){
            $mainCategory = Category::where('name',$category)->first();
            if(!empty($mainCategory)){
                $data['allSubCategories'] = Category::where('parent_id',$mainCategory['id'])->where('status','active')->get();
                $subCategory = Category::where('parent_id',$mainCategory['id'])->where('name',$sub_category)->first();
                if(empty($subCategory)){
                    Category::create([
                        'parent_id'=>$mainCategory['id'],
                        'name' =>$sub_category
                    ]);
                    $subCategory = Category::where('parent_id',$mainCategory['id'])->where('name',$sub_category)->first();
                }
                $data['allSkills'] = CategorySkill::where('category_id',$subCategory['id'])->get();
                if($data['allSkills']->isEmpty()){
                    $subCategoryIds = Category::where('parent_id', $mainCategory['id'])->pluck('id')->toArray();
                    $allSkills = CategorySkill::whereIn('category_id', $subCategoryIds)->get();

                    // Use PHP to filter unique records by name
                    $uniqueSkills = [];
                    $processedNames = [];
                    foreach ($allSkills as $skill) {
                        if (!in_array($skill->name, $processedNames)) {
                            $uniqueSkills[] = $skill;
                            $processedNames[] = $skill->name;
                        }
                    }
                    $data['allSkills'] = collect($uniqueSkills);
                }
            }else{
                $data['allSubCategories'] = [];
                $data['allSkills'] = [];
            }
        }else{
            $data['allSubCategories'] = [];
            $data['allSkills'] = [];
        }
        return $data;
    }

    public function addNewCat(){
        $skillCategories = [
            [
                "Graphics and Design" => [
                    [
                        "sub_category" => "Logo Design",
                        "skill" => ["Graphic Design", "Typography", "Color Theory", "Simplicity", "Versatility", "Brand Identity"]
                    ],
                    [
                        "sub_category" => "Business Cards & Stationery",
                        "skill" => ["Layout Design", "Print Design", "Consistency", "Paper and Material Knowledge", "Branding Integration"]
                    ],
                    [
                        "sub_category" => "Illustration",
                        "skill" => ["Drawing skill", "Digital Illustration", "Storytelling through Images", "Character Design", "Concept Art"]
                    ],
                    [
                        "sub_category" => "AI Artists",
                        "skill" => ["Machine Learning", "Data Input and Processing", "Adaptability", "Human-AI Collaboration", "Ethical Considerations"]
                    ],
                    [
                        "sub_category" => "Cartoons & Comics",
                        "skill" => ["Character Design", "Panel Layout", "Humor and Style", "Storyboarding", "Digital Tools"]
                    ],
                    [
                        "sub_category" => "Tattoo Design",
                        "skill" => ["Detailing", "Anatomy Knowledge", "Customization", "Symbolism", "Versatility"]
                    ],
                    [
                        "sub_category" => "NFT Art",
                        "skill" => ["Blockchain Knowledge", "Digital Art skill", "Metadata Integration", "Crypto Wallet Usage", "Marketplace Awareness"]
                    ],
                    [
                        "sub_category" => "Pixel Art",
                        "skill" => ["Pixelation Techniques", "Color Limitations", "Animation", "Tileset Design", "Retro Aesthetics"]
                    ],
                    [
                        "sub_category" => "Design Advice",
                        "skill" => ["Communication skill", "Client Interaction", "Trend Awareness", "Problem Solving"]
                    ],
                    [
                        "sub_category" => "Website Design",
                        "skill" => ["UI/UX Design", "Responsive Design", "Coding skill", "Wireframing", "Typography and Color"]
                    ],
                    [
                        "sub_category" => "App Design",
                        "skill" => ["Mobile UX/UI", "Platform Guidelines", "Navigation Design", "Integration of Features", "Prototyping"]
                    ],
                    [
                        "sub_category" => "UX Design",
                        "skill" => ["User Research", "Information Architecture", "Usability Testing", "Persona Creation", "Accessibility"]
                    ],
                    [
                        "sub_category" => "Landing Page Design",
                        "skill" => ["Conversion Optimization", "Visual Hierarchy", "Call-to-Action (CTA) Design", "Loading Speed Optimization", "A/B Testing"]
                    ],
                    [
                        "sub_category" => "Icon Design",
                        "skill" => ["Simplicity", "Consistency", "Scalability", "Platform Guidelines", "Color and Symbolism"]
                    ],
                    [
                        "sub_category" => "Industrial & Product Design",
                        "skill" => ["CAD skill", "Material Knowledge", "Ergonomics", "Prototyping", "User-Centered Design"]
                    ],
                    [
                        "sub_category" => "Character Modeling",
                        "skill" => ["3D Modeling", "Texturing", "Rigging", "Animation", "Expression and Pose Design"]
                    ],
                    [
                        "sub_category" => "Game Art",
                        "skill" => ["Environment Design", "Concept Art", "Sprite Animation", "Texture Mapping", "Understanding Game Engines"]
                    ],
                    [
                        "sub_category" => "Graphics for Streamers",
                        "skill" => ["Overlay Design", "Branding Integration", "Animation for Streams", "Interactive Graphics", "Platform-Specific Graphics"]
                    ],
                    [
                        "sub_category" => "Flyer Design",
                        "skill" => ["Visual Impact", "Typography", "Layout Design", "Color Harmony", "Print-Friendly Design"]
                    ],
                    [
                        "sub_category" => "Brochure Design",
                        "skill" => ["Information Organization", "Fold and Layout Knowledge", "Imagery Integration", "Consistency", "Print Production Knowledge"]
                    ],
                    [
                        "sub_category" => "Poster Design",
                        "skill" => ["Visual Hierarchy", "Typography Impact", "Composition", "Color Psychology", "Theme Representation"]
                    ],
                    [
                        "sub_category" => "Catalog Design",
                        "skill" => ["Product Photography Integration", "Grid Layout", "Consistent Branding", "Product Information", "Print Optimization"]
                    ],
                    [
                        "sub_category" => "Menu Design",
                        "skill" => ["Visual Appetite Appeal", "Typography for Readability", "Categorization", "Consistent Branding", "Print and Size Considerations"]
                    ],
                    [
                        "sub_category" => "Image Editing",
                        "skill" => ["Photo Retouching", "Color Correction", "Cut-Outs and Masking", "Compositing", "Image Restoration"]
                    ],
                    [
                        "sub_category" => "Presentation Design",
                        "skill" => ["Slide Layout", "Data Visualization", "Consistent Theme", "Animation for Emphasis", "Audience Engagement"]
                    ],
                    [
                        "sub_category" => "Background Removal",
                        "skill" => ["Selection Techniques", "Masking skill", "Fine Edges", "Refinement", "Understanding of Lighting"]
                    ],
                    [
                        "sub_category" => "Infographic Design",
                        "skill" => ["Information Simplification", "Data Representation", "Color Coding", "Typography for Clarity", "Iconography"]
                    ],
                    [
                        "sub_category" => "Vector Tracing",
                        "skill" => ["Precision", "Path Editing", "Color Conversion", "Consistency in Style", "Understanding File Formats"]
                    ],
                    [
                        "sub_category" => "Social Media Design",
                        "skill" => ["Platform-Specific Design", "Visual Storytelling", "Branding Consistency", "Engagement Elements", "Trend Awareness"]
                    ],
                    [
                        "sub_category" => "Social Posts & Banners",
                        "skill" => ["Content Alignment", "Hashtag Integration", "Size Optimization", "Call-to-Action", "Story Highlights"]
                    ],
                    [
                        "sub_category" => "Email Design",
                        "skill" => ["Responsive Layouts", "Clear Call-to-Action", "Visual Hierarchy", "Branded Templates", "A/B Testing"]
                    ],
                    [
                        "sub_category" => "Web Banners",
                        "skill" => ["Eye-catching Design", "Click-Worthiness", "Consistent Branding", "Size and Format Knowledge", "Animation for Web"]
                    ],
                    [
                        "sub_category" => "Signage Design",
                        "skill" => ["Visibility", "Contrast", "Readability", "Branding Integration", "Information Hierarchy"]
                    ]
                ]
            ],
            [
                "Technology and Development" => [
                    [
                        "sub_category" => "Web Development",
                        "skill" => ["HTML", "CSS", "JavaScript", "Python", "Ruby", "PHP", "Java", "Node.js", "TypeScript", "Go", "Scala", "ASP.NET", "Django", "Flask", "Express.js"]
                    ],
                    [
                        "sub_category" => "Mobile Development",
                        "skill" => ["Java", "Kotlin", "Swift", "Objective-C", "React Native", "Flutter", "Xamarin", "Ionic", "PhoneGap", "NativeScript"]
                    ],
                    [
                        "sub_category" => "Desktop Development",
                        "skill" => ["Java", "C#", "Python", "C++", "Swift", "Objective-C", "Electron", "GTK", "Qt", "WPF", "WinForms", "Tkinter"]
                    ],
                    [
                        "sub_category" => "Game Development",
                        "skill" => ["C++", "C#", "Unity", "Unreal Engine", "JavaScript", "Lua", "Godot", "Pygame", "LÖVE", "Phaser"]
                    ],
                    [
                        "sub_category" => "Data Science and Analytics",
                        "skill" => ["Python", "R", "SQL", "Julia", "MATLAB/Octave", "Scala", "SAS", "SPSS", "Mathematica", "Apache Spark", "Hadoop"]
                    ],
                    [
                        "sub_category" => "Embedded Systems Development",
                        "skill" => ["C", "C++", "Assembly language", "Rust", "Ada", "VHDL/Verilog", "Embedded C", "MicroPython", "FreeRTOS"]
                    ],
                    [
                        "sub_category" => "Systems Programming",
                        "skill" => ["C", "C++", "Rust", "Go", "D", "Zig", "Nim", "Assembly language", "Swift", "Kotlin Native"]
                    ],
                    [
                        "sub_category" => "DevOps and Infrastructure Automation",
                        "skill" => ["Python", "Ruby", "Shell scripting", "YAML", "Ansible", "Chef", "Puppet", "Terraform", "SaltStack", "PowerShell"]
                    ],
                    [
                        "sub_category" => "Enterprise Applications",
                        "skill" => ["Java", "C#", "Python", "JavaScript", "TypeScript", "PHP", "Ruby", "Scala", "Groovy", "Kotlin", "Perl", "Visual Basic .NET"]
                    ],
                    [
                        "sub_category" => "Artificial Intelligence and Robotics",
                        "skill" => ["Python", "C++", "MATLAB/Octave", "Java", "Lisp", "Prolog", "ROS", "TensorFlow", "PyTorch", "Keras", "OpenCV", "PDDL", "Cython", "Julia", "Haskell", "MATLAB Robotics System Toolbox"]
                    ]
                ]
            ],
            [
                "Digital Marketing" => [
                    [
                        "sub_category" => "SEO Specialist",
                        "skill" => ["On-Page SEO", "Off-Page SEO", "Technical SEO"]
                    ],
                    [
                        "sub_category" => "Content Marketing Manager",
                        "skill" => ["Content Strategy", "Content Creation", "Content Distribution"]
                    ],
                    [
                        "sub_category" => "Social Media Marketing Expert",
                        "skill" => ["Platform-Specific Strategies", "Social Media Advertising", "Community Management"]
                    ],
                    [
                        "sub_category" => "Email Marketing Specialist",
                        "skill" => ["Email Campaign Management", "Email Automation", "List Segmentation"]
                    ],
                    [
                        "sub_category" => "PPC Advertising Consultant",
                        "skill" => ["Google Ads", "Display Advertising", "Remarketing/Retargeting"]
                    ],
                    [
                        "sub_category" => "Analytics and Data Analyst",
                        "skill" => ["Google Analytics", "A/B Testing", "KPI Analysis"]
                    ],
                    [
                        "sub_category" => "Conversion Rate Optimization (CRO) Expert",
                        "skill" => ["A/B Testing", "User Experience Optimization", "Landing Page Optimization"]
                    ],
                    [
                        "sub_category" => "Marketing Automation Consultant",
                        "skill" => ["Marketing Funnel Automation", "Workflow Automation", "Lead Nurturing"]
                    ]
                ]
            ]
        ];

        //return $skillCategories;

        foreach ($skillCategories as $key => $catArr){
            $mainCat = array_keys($catArr);
            $existCategory = Category::where('name',$mainCat[0])->first();
            $mcId = 0;
            if(empty($existCategory)){
                $catData['name'] = $mainCat[0];
                $newCategory = Category::create($catData);
                $mcId = $newCategory['id'];
            }else{
                $mcId = $existCategory['id'];
            }

            foreach ($catArr as $key1 => $cat){
                foreach ($cat as $key2 => $val){
                    $existSubCat = Category::where('parent_id',$mcId)->where('name',$val['sub_category'])->first();
                    $scId = 0;
                    if(empty($existSubCat)){
                        $subCatData['parent_id'] = $mcId;
                        $subCatData['name'] = $val['sub_category'];
                        $newSubCat = Category::create($subCatData);
                        $scId = $newSubCat['id'];
                    }else{
                        $scId = $existSubCat['id'];
                    }
                    foreach ($val['skill'] as $key3=> $val1){
                        $existSkill = CategorySkill::where('category_id',$scId)->where('name',$val1)->first();
                        if(empty($existSkill)){
                            $skillData['category_id'] = $scId;
                            $skillData['name'] = $val1;
                            CategorySkill::create($skillData);
                        }
                    }
                }
            }
        }
        return 'Done';
    }

    public function getSubCategory(Request $request){
        $category = Category::where('id',$request['categoryId'])->where('status','active')->first();
        $data['result'] = 0;
        $option = '';
        if(!empty($category)){
            $subCategory = Category::where('parent_id',$request['categoryId'])->where('status','active')->get();
            if(!empty($subCategory)){
                foreach ($subCategory as $sCat){
                    $option .= '<option value="'.$sCat['id'].'">'.$sCat['name'].'</option>';
                }
                $data['option'] = $option;
                $data['result'] = 1;
            }else{
                $data['result'] = 0;
            }
        }else{
            $data['result'] = 0;
        }
        return $data;
    }

    public function getContent(Request $request){
        $skillCategories = [];
        $subcategory = Category::with('parentCategory','getSkills')->where('parent_id','!=',0)
            ->where('status','active')->get();
        if(count($subcategory) > 0){
            foreach ($subcategory as $list){
                $skillArr = [];
                if(count($list['getSkills']) > 0){
                    foreach ($list['getSkills'] as $skill){
                        $skillArr[] = $skill['name'];
                    }
                }
                $skillCategories[] = ['main_category'=>$list['parentCategory']['name'], 'sub_category' => $list['name'], 'skill' => $skillArr];
            }
        }

        $jsonSkill = json_encode($skillCategories);
        $data['content'] = $skillCategories;
        $data['skill_json'] = substr($jsonSkill,1,-1);
        return $data;
    }
}