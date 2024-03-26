<?php

namespace App\Http\Controllers\Frontend\Project;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PusherController;
use App\Models\AcceptOffer;
use App\Models\Category;
use App\Models\CategorySkill;
use App\Models\MakeOffer;
use App\Models\Message;
use App\Models\Milestone;
use App\Models\Post;
use App\Models\PostSkill;
use App\Models\User;
use App\Models\Team;
use App\Models\UserSkill;
use App\Models\Project;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
use App\Lib\PusherFactory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function show($id)
    {
        $project = Post::where('id', $id)->with('getJobPoster', 'getPostImages', 'getBudgetTypes', 'getPostSkills', 'getOffers', 'getAcceptedOffers')->first();
        if(isset($project)) {
            $projects = Post::where('user_id', $project->user_id)->with('getJobPoster', 'getPostImages', 'getBudgetTypes', 'getPostSkills', 'getOffers', 'getAcceptedOffers')->get();
            $milestones = [];
            $inprogress = 0;
            $released = 0;
            if(Milestone::where("project_id", $id)->exists()) {
                $milestones = Milestone::where("project_id", $id)->where("accept_offer_id", $project->getAcceptedOffers->id)->get();
                foreach($milestones as $milestone) {
                    if($milestone->status == "active")
                        $inprogress += $milestone->amount;
                    else if($milestone->status == "done")
                        $released += $milestone->amount;
                }
            }

            $offer_made = false;
            $loginUser = Auth::user();
            if(count($project->getOffers) != 0) {
                foreach($project->getOffers as $offer) {
                    if(!empty($loginUser)){
                        if($offer->user_id == Auth::user()->id) {
                            $offer_made = true;
                            break;
                        }
                    }
                }
            }

            return view('frontend.projects.project-new', ['state' => 1, 'project' => $project, 'projects' => $projects, "milestones" => $milestones, "inprogress"=>$inprogress, "released"=>$released, "offer_made" => $offer_made]);
        } else {
            return view('frontend.projects.project-new', ['state' => 0]);
        }
    }

    public function viewUserProfile(Request $request, $id)
    {


        $user = User::where('id', $id)->first();
        $team = Team::where('owner_id', $id)->where('deleted', null)->first();

        $team_member = DB::table('team_users')
            ->join('teams', 'team_users.team_id', '=', 'teams.id')
            ->select('team_users.*', 'teams.*')
            ->where('teams.deleted', null)
            ->where('team_users.user_id', $user->id)->get();

        if (!is_null($user)) {
            $categories = Category::where('parent_id',0)->get();
            $projects = Project::where('user_id', $user->id)->where('status', 'done')->get();
            $posts = Post::where('user_id', $user->id)->get();
            $portfolios = Portfolio::where('user_id', $user->id)->get();
            $userSkills = UserSkill::where('user_id', $id)->with('getSkills')->get();
            $allSkills =  CategorySkill::all();
            $allSubCategory = [];
            $parentCategoryId = 0;
            if(count($userSkills) > 0){
                $subCategory = Category::where('id',$userSkills[0]['category_id'])->first();
                if(!empty($subCategory)){
                    $parentCategory = Category::where('id',$subCategory['parent_id'])->first();
                    $parentCategoryId = !empty($parentCategory) ? $parentCategory['id'] : 0;
                    $allSubCategory = Category::where('parent_id',$subCategory['parent_id'])->get();
                    //$allSkills = CategorySkill::where('category_id',$subCategory['id'])->get();
                }
            }
            return view('frontend.projects.view-user-profile', ['user' => $user,'parentCategoryId' =>$parentCategoryId, 'subCategory'=>$allSubCategory, 'allSkills'=>$allSkills, 'userSkills' => $userSkills, 'projects'=> $projects, 'portfolios' => $portfolios, 'posts'=>$posts, 'categories'=>$categories, 'team'=> $team, 'team_member'=>$team_member]);
        } else {
            Toastr::error('User is not exist', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function my_posts(Request $request)
    {
        $orderBy = isset($request->orderBy) ? $request->orderBy : 'DESC';
        if (isset($request->category_id)) {
            $jobs = Post::where('user_id', Auth::user()->id)->where('category_id', $request->category_id)->with('getJobPoster', 'getPostImages', 'getBudgetTypes', 'getPostSkills')->orderBy('created_at', $orderBy)->paginate(6);
        } else {
            $jobs = Post::where('user_id', Auth::user()->id)->with('getJobPoster', 'getPostImages', 'getBudgetTypes', 'getPostSkills')->orderBy('created_at', $orderBy)->paginate(6);
        }
        $categories = Category::all();
        $data = Post::selectRaw('count(category_id) as job_count, category_id')->groupBy('category_id')->get();
        $jobs_category_count = [];
        foreach ($data as $value) {
            $jobs_category_count[$value->category_id] = $value->job_count;
        }

        return view('frontend.projects.my-posts', ['jobs' => $jobs, 'categories' => $categories, 'jobs_category_count' => $jobs_category_count]);
    }

    public function my_jobs(Request $request)
    {
        $orderBy = isset($request->orderBy) ? $request->orderBy : 'DESC';
        if (isset($request->filter)) {
            if ($request->filter != 'all') $jobs = AcceptOffer::where('status', $request->filter)->where('user_id', Auth::user()->id)->orderBy('created_at', $orderBy)->paginate(6);
            else $jobs = AcceptOffer::where('user_id', Auth::user()->id)->orderBy('created_at', $orderBy)->paginate(6);
        } else {
            $jobs = AcceptOffer::where('user_id', Auth::user()->id)->orderBy('created_at', $orderBy)->paginate(6);
        }
        $categories = Category::all();
        $data = Post::selectRaw('count(category_id) as job_count, category_id')->groupBy('category_id')->get();
        $jobs_category_count = [];
        foreach ($data as $value) {
            $jobs_category_count[$value->category_id] = $value->job_count;
        }

        return view('frontend.projects.my-jobs', ['jobs' => $jobs, 'categories' => $categories, 'jobs_category_count' => $jobs_category_count, 'filter'=>$request->filter]);
    }

    public function my_jobs_filter(Request $request, $filter)
    {
        $orderBy = isset($request->orderBy) ? $request->orderBy : 'DESC';
        if (isset($filter)) {
            if ($filter != 'all') $jobs = Project::where('status', $filter)->where('user_id', Auth::user()->id)->orderBy('created_at', $orderBy)->paginate(6);
            else $jobs = Project::where('user_id', Auth::user()->id)->orderBy('created_at', $orderBy)->paginate(6);
        } else {
            $jobs = Project::where('user_id', Auth::user()->id)->orderBy('created_at', $orderBy)->paginate(6);
        }
        $categories = Category::all();
        $data = Post::selectRaw('count(category_id) as job_count, category_id')->groupBy('category_id')->get();
        $jobs_category_count = [];
        foreach ($data as $value) {
            $jobs_category_count[$value->category_id] = $value->job_count;
        }
        dd($filter);

        return view('frontend.projects.my-jobs', ['jobs' => $jobs, 'categories' => $categories, 'jobs_category_count' => $jobs_category_count, 'filter'=>$filter]);
    }

    public function makeoffer(Request $request)
    {
        $post = Post::where('id', $request->post_id)->first();
        $makeOffer = MakeOffer::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'post_user_id' => $post->user_id,
            'amount' => $request->amount,
            'description' => $request->description
        ]);
        if ($makeOffer) {
            $pusherController = new PusherController();
            $nofification_data = [];
            $nofification_data['post_id'] = $request->post_id;
            $nofification_data['from_user'] = auth()->user()->id;
            $nofification_data['content'] = "There is a user who make an offer to your project. Click here to see more.";
            $nofification_data['to'] = $post->user_id;
            $nofification_data['type'] = 1;
            $notification = Notification::create($nofification_data);
            $nofification_data['from_user_name'] = auth()->user()->name;
            $nofification_data['post_date'] = $notification->date_time_str;
            $pusherController->notify($nofification_data);
            return response()->json(['success' => true, 'skills' => $makeOffer, 'message' => 'Successfully Offer Made']);
        } else {
            return response()->json(['success' => false, 'message' => 'Make Offer occured some error']);
        }
    }

    public function acceptoffer(Request $request)
    {
        $pid = $request->post_id;
        $to_user_id = $request->touserid;
        $post = Post::where("id", $pid)->first();

        if (AcceptOffer::where('user_id', $to_user_id)->where('post_id', $pid)->where('post_user_id', $post->user_id)->where('status', "active")->exists()) {
            return response()->json(['success' => false, 'message' => 'Already offer accepted']);
        } else {
            AcceptOffer::create([
                "user_id" => $to_user_id,
                "post_id" => $pid,
                "post_user_id" => $post->user_id,
                "status" => "active"
            ]);
        }
        $data = [];
        $data["status"] = "awarded";
        Post::where('id', $pid)->update($data);
        $pusherController = new PusherController();
        $nofification_data = [];
        $nofification_data['post_id'] = $pid;
        $nofification_data['from_user'] = auth()->user()->id;
        $nofification_data['content'] = "You have been awarded a project(".$post->name."), press here to view offer and negotiate price.";
        $nofification_data['to'] = $to_user_id;
        $nofification_data['type'] = 1;
        $notification = Notification::create($nofification_data);
        $nofification_data['from_user_name'] = auth()->user()->name;
        $nofification_data['post_date'] = $notification->date_time_str;
        $pusherController->notify($nofification_data);

        return response()->json(['state' => 1]);
    }

    public function createMilestone(Request $request) {
        $pid = $request->project_id;
        $amount = $request->amount;
        $description = $request->description;
        $post = Post::where("id", $pid)->first();
        $poster = User::where("id", $post->user_id)->first();
        $accept_offer = $post->getAcceptedOffers;
        if($amount > $poster->balance) {
            return response()->json(['state' => 0]);
        } else {
            $data = [];
            $bal = $poster->balance-$amount;
            $data["balance"] = $bal;
            User::where("id", $poster->id)->update($data);
            Milestone::create([
                "project_id" => $pid,
                "accept_offer_id" => $accept_offer->id,
                "amount" => $amount,
                "description" => $description,
                "status" => "active"
            ]);

            $pusherController = new PusherController();
            $nofification_data = [];
            $nofification_data['post_id'] = $pid;
            $nofification_data['from_user'] = auth()->user()->id;
            $nofification_data['content'] = "The milestone for $".$amount." has been created for ".$post->name;
            $nofification_data['to'] = $accept_offer->user_id;
            $nofification_data['type'] = 3;
            $notification = Notification::create($nofification_data);
            $nofification_data['from_user_name'] = auth()->user()->name;
            $nofification_data['post_date'] = $notification->date_time_str;
            $pusherController->notify($nofification_data);
            $milestones = Milestone::where("project_id", $pid)->where("accept_offer_id", $accept_offer->id)->get();
            return response()->json(['state' => 1, 'balance' => $bal, 'milestones' => $milestones, 'to_user_id' => $accept_offer->user_id]);
        }
    }

    public function releaseMilestone(Request $request) {
        $mid = $request->mid;

        $data = [];
        $data["status"] = "done";
        Milestone::where("id", $mid)->update($data);
        $milestone = Milestone::where("id", $mid)->first();
        $accept_offer = AcceptOffer::where("id", $milestone->accept_offer_id)->first();
        $accepted_user = User::where("id", $accept_offer->user_id)->first();
        $data2 = [];
        $data2["balance"] = $accepted_user->balance + $milestone->amount;
        User::where("id", $accept_offer->user_id)->update($data2);

        $pusherController = new PusherController();
        $post = Post::where("id", $milestone->project_id)->first();
        $nofification_data = [];
        $nofification_data['post_id'] = $milestone->project_id;
        $nofification_data['from_user'] = auth()->user()->id;
        $nofification_data['content'] = "Milestone(".$milestone->description.") for the project(".$post->name.") is released.";
        $nofification_data['to'] = $accept_offer->user_id;
        $nofification_data['type'] = 3;
        $notification = Notification::create($nofification_data);
        $nofification_data['from_user_name'] = auth()->user()->name;
        $nofification_data['post_date'] = $notification->date_time_str;
        $pusherController->notify($nofification_data);
        $milestones = Milestone::where("project_id", $milestone->project_id)->where("accept_offer_id", $milestone->accept_offer_id)->get();
        return response()->json(['state' => 1, 'milestones' => $milestones]);
    }

    public function userAcceptOffer(Request $request)
    {
        $pid = $request->post_id;
        $post = Post::where("id", $pid)->first();
        if (AcceptOffer::where('post_id', $pid)->where('post_user_id', $post->user_id)->where('status', "active")->exists()) {
            AcceptOffer::where('post_id', $pid)->where('post_user_id', $post->user_id)->update(['status' => 'accepted']);
            $data = [];
            $data["status"] = "progress";
            Post::where('id', $pid)->update($data);

            $pusherController = new PusherController();
            $nofification_data = [];
            $nofification_data['post_id'] = $pid;
            $nofification_data['from_user'] = auth()->user()->id;
            $nofification_data['content'] = auth()->user()->name." has accepted your project.";
            $nofification_data['to'] = $post->user_id;
            $nofification_data['type'] = 1;
            $notification = Notification::create($nofification_data);
            $nofification_data['from_user_name'] = auth()->user()->name;
            $nofification_data['post_date'] = $notification->date_time_str;
            $pusherController->notify($nofification_data);

            return response()->json(['state' => 1, 'to_user_id' => $post->user_id]);
        } else {
            return response()->json(['state' => 0]);
        }
    }

    public function deleteProject(Request $request) {
        $pid = $request->pid;
        $post = Post::where("id", $pid)->first();
        if(isset($post->getOffers)) {
            foreach($post->getOffers as $offer) {
                $pusherController = new PusherController();
                $nofification_data = [];
                $nofification_data['post_id'] = $pid;
                $nofification_data['from_user'] = auth()->user()->id;
                $nofification_data['content'] = "The project(".$post->name.") you made an offer is removed from the project list.";
                $nofification_data['to'] = $offer->user_id;
                $nofification_data['type'] = 1;
                $notification = Notification::create($nofification_data);
                $nofification_data['from_user_name'] = auth()->user()->name;
                $nofification_data['post_date'] = $notification->date_time_str;
                $pusherController->notify($nofification_data);
            }
        }

        Notification::where("post_id", $pid)->delete();
        Message::where("post_id", $pid)->delete();
        MakeOffer::where("post_id", $pid)->delete();
        Post::where("id", $pid)->delete();

        return response()->json(['state' => 1]);
    }

    public function messages(Request $request)
    {
        return view('frontend.Chat.chat');
    }

    public function hire(Request $request)
    {
        $user = User::where('id', $request->user_id)->where('status', 'active')->first();
        $userSkills = UserSkill::where('user_id', $request->user_id)->get();
        $post = Post::create([
            'user_id' => $request->user_id,
            'name' => $request->title,
            'date' => $request->date,
            'beforedate' => $request->beforedate,
            'description' => $request->description,
            'amount' => $request->amount,
            'budget_id' => $request->budget,
            'category_id' => $user->category_id,
        ]);
        if ($post) {
            if (count($userSkills) > 0) {
                foreach ($userSkills as $uskill) {
                    PostSkill::create([
                        'post_id' => $post->id,
                        'skill_id' => $uskill->skill_id
                    ]);
                }
            }

            AcceptOffer::create([
                'user_id' => $request->request_user_id,
                'post_id' => $post->id,
                'post_user_id' => $post->user_id
            ]);

            $message = Message::create([
                'post_id' => $post->id,
                'from_user' => $post->user_id,
                'to_user' => $request->request_user_id,
                'content' => $request->description
            ]);
            $message->dateTimeStr = date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString()));
            $message->dateHumanReadable = $message->date_human_readable;
            $message->fromUserName = $message->fromUser->name;
            $message->from_user_id = Auth::user()->id;
            $message->toUserName = $message->toUser->name;
            $message->to_user_id = $request->to_user;
            PusherFactory::make()->trigger('chat', 'send', ['data' => $message]);
            return response()->json(['success' => true, 'message' => 'Successfully sent your hire request']);
        } else {
            return response()->json(['success' => false, 'message' => 'Oops! something went wrong']);
        }
    }
}
