<?php

namespace App\Http\Controllers\Frontend\Job;

use App\Http\Controllers\Controller;
use App\Models\CategorySkill;
use App\Models\PostSkill;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Events\NotificationEvent;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = isset($request->filterBy) ? $request->filterBy : 'DESC';
        $query = Post::where('status', 'active')->with('getJobPoster', 'getPostImages', 'getBudgetTypes', 'getPostSkills','getPostCategory','getPostSubCategory')->select();
        $data['subCategory'] = [];
        $skillsQuery = CategorySkill::with('allPost')->select();
        $data['selected_cat'] = '';
        $data['selected_sub_cat'] = '';
        $data['selected_skill'] = '';
        $data['search_name'] = '';
        $data['filter_by'] = $orderBy;
        if(isset($request->name)){
            $data['search_name'] = $request->name;
            $query->where('name','like','%'.$request->name.'%');
        }

        if (isset($request->category)) {
            $query->where('category_id', $request->category);
            $data['selected_cat'] = $request->category;
            $data['subCategory'] = Category::where('parent_id',$request['category'])->where('status','active')->get();
            if(count($data['subCategory']) > 0){
                $catIds = $data['subCategory']->map(function ($category) {
                    return $category->id;
                })->toArray();
                $skillsQuery->whereIn('category_id',$catIds);
            }
        }

        if (isset($request->sub_category)) {
            $data['selected_sub_cat'] = $request->sub_category;
            $query->where('subcategory_id', $request->sub_category);
            $skillsQuery->where('category_id',$request->sub_category);
        }

        if(isset($request->skills_id)){
            $data['selected_skill'] = $request->skills_id;
            $postIds = PostSkill::where('skill_id',$request->skills_id)->pluck('post_id');
            $query->whereIn('id',$postIds);
        }

        $data['jobs'] = $query->orderBy('created_at', $orderBy)->paginate(6);

        $data['allCategory'] = Category::where('parent_id',0)->where('status','active')->get();
        $data['sel_category'] = null;
        $data['sel_sort'] = null;
        $data['skills'] = $skillsQuery->get();
        return view('frontend.jobs.find-jobs', $data);
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        // $jobs = Post::where('status', 'active')->where('name', 'LIKE', '%' . $request->name . '%')->whereIn("category_id", explode(",", $request->category ))->orderBy('created_at', $request->sort)->with('getJobPoster', 'getPostImages', 'getBudgetTypes', 'getPostSkills')->paginate(6);
        $jobs = Post::where('status', 'active');
        if (!is_null($request->name) && isset($request->name)) {
            $jobs = $jobs->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if (!is_null($request->category) && isset($request->category)) {
            $jobs = $jobs->whereIn("category_id", explode(",", $request->category ));
        }
        if (!is_null($request->sort) && isset($request->sort)) {
            $jobs = $jobs->orderBy('created_at', $request->sort);
        }
        $jobs = $jobs->paginate(6);
        $data = Post::selectRaw('count(category_id) as job_count, category_id')->groupBy('category_id')->get();
        $jobs_category_count = [];

        foreach ($data as $value) {
            $jobs_category_count[$value->category_id] = $value->job_count;
        }

        return view('frontend.jobs.find-jobs', ['jobs' => $jobs, 'categories' => $categories, 'jobs_category_count' => $jobs_category_count, "sel_name"=>$request->name, "sel_category"=> explode(",", $request->category ), "sel_sort"=>$request->sort]);
    }

    public function filter(Request $request)
    {
        $categories = Category::all();
        $jobs = Post::where('status', 'active')->where('name', 'LIKE', '%' . $request->name . '%')->with('getJobPoster', 'getPostImages', 'getBudgetTypes', 'getPostSkills')->paginate(6);
        $data = Post::selectRaw('count(category_id) as job_count, category_id')->groupBy('category_id')->get();
        $jobs_category_count = [];

        foreach ($data as $value) {
            $jobs_category_count[$value->category_id] = $value->job_count;
        }

        return view('frontend.jobs.find-jobs', ['jobs' => $jobs, 'categories' => $categories, 'jobs_category_count' => $jobs_category_count]);
    }

    public function getJobSubCategory(Request $request){
        $category = Category::where('id',$request['categoryId'])->where('status','active')->first();
        $data['result'] = 0;
        $data['post'] = [];
        $option = '';
        if(!empty($category)){
            $data['post'] = Post::where('category_id',$request['categoryId'])->where('status','active')->get();
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

    public function getJobList(Request $request){
        $data['selected_skill'] = '';
        $query = Post::where('status', 'active')->with('getJobPoster', 'getPostImages', 'getBudgetTypes', 'getPostSkills','getPostCategory','getPostSubCategory')->select();
        $skillsQuery = CategorySkill::with('allPost')->select();
        $orderBy = isset($request->filterBy) ? $request->filterBy : 'DESC';
        $data['subcatChange'] = 0;
        $option = '';
        if(isset($request->jobName)){
            $data['search_name'] = $request->jobName;
            $query->where('name','like','%'.$request->jobName.'%');
        }

        if (isset($request->categoryId)) {
            $query->where('category_id', $request->categoryId);
            $subCategory = Category::where('parent_id',$request->categoryId)->where('status','active')->get();
            if(count($subCategory) > 0){
                $catIds = $subCategory->map(function ($category) {
                    return $category->id;
                })->toArray();
                $skillsQuery->whereIn('category_id',$catIds);

                foreach ($subCategory as $sCat){
                    $option .= '<option value="'.$sCat['id'].'">'.$sCat['name'].'</option>';
                }
                $data['option'] = $option;
            }
            $data['subcatChange'] = 1;
        }

        if (isset($request->subcategorId)) {
            $data['selected_sub_cat'] = $request->subcategorId;
            $query->where('subcategory_id', $request->subcategorId);
            $skillsQuery->where('category_id',$request->subcategorId);
            $data['subcatChange'] = 0;
        }

        if(isset($request->jobSkills)){
            $data['selected_skill'] = $request->jobSkills;
            $postIds = PostSkill::where('skill_id',$request->jobSkills)->pluck('post_id');
            $query->whereIn('id',$postIds);
        }
        $data['jobs'] = $query->orderBy('created_at', $orderBy)->paginate(6);
        $data['skills'] = $skillsQuery->get();
        $data['content'] = view('frontend.jobs.list',$data)->render();
        return $data;
    }
}
