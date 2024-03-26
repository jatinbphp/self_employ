<?php

namespace App\Http\Controllers\Frontend\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySkill;
use App\Models\PostSkill;
use App\Models\User;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelancerController extends Controller
{
    public function index(Request $request)
    {
        $orderBy = isset($request->filterBy) ? $request->filterBy : 'DESC';
        $data['subCategory'] = [];
        $skillsQuery = CategorySkill::with('allUserSkill')->select();
        $data['selected_cat'] = '';
        $data['selected_sub_cat'] = '';
        $data['selected_skill'] = '';
        $data['search_name'] = '';
        $data['filter_by'] = $orderBy;
        $query = User::where('role_id', 2)->select();
        if(Auth::check()){
            $query->whereNotIn('id', [Auth::user()->id]);
        }

        if(isset($request->name)){
            $data['search_name'] = $request->name;
            $query->where('first_name','like','%'.$request->name.'%')->orwhere('last_name','like','%'.$request->name.'%');
        }

        if (isset($request->category)) {
            //$query->where('category_id', $request->category);
            $data['selected_cat'] = $request->category;
            $data['subCategory'] = Category::where('parent_id',$request['category'])->where('status','active')->get();
            if(count($data['subCategory']) > 0){
                $catIds = $data['subCategory']->map(function ($category) {
                    return $category->id;
                })->toArray();
                $skillsQuery->whereIn('category_id',$catIds);
                $userIds = UserSkill::whereIn('category_id',$catIds)->pluck('user_id');
                $query->whereIn('id',$userIds);
            }
        }

        if (isset($request->sub_category)) {
            $data['selected_sub_cat'] = $request->sub_category;
            //$query->where('subcategory_id', $request->sub_category);
            $skillsQuery->where('category_id',$request->sub_category);
            $userIds = UserSkill::where('category_id',$request->sub_category)->pluck('user_id');
            $query->whereIn('id',$userIds);
        }

        if(isset($request->userSkill)){
            $data['selected_skill'] = $request->userSkill;
            $userIds = UserSkill::where('skill_id',$request->userSkill)->pluck('user_id');
            $query->whereIn('id',$userIds);
        }

        $data['users'] = $query->orderBy('created_at', $orderBy)->paginate('10');
        $data['allCategory'] = Category::where('parent_id',0)->where('status','active')->get();
        $data['skills'] = $skillsQuery->get();
        return view('frontend.freelancer.freelancer', $data);
    }

    public function getFreelancerList(Request $request){
        $data['status'] = 0;
        $data['selected_skill'] = '';
        $data['subcatChange'] = 0;
        $option = '';
        $query = User::where('role_id', 2)->select();
        $skillsQuery = CategorySkill::with('allUserSkill')->select();
        if(isset($request->freelancerName)){
            $data['search_name'] = $request->freelancerName;
            $query->where(function ($innerQuery) use ($request) {
                $innerQuery->where('first_name','like','%'.$request->freelancerName.'%');
                $innerQuery->orwhere('last_name','like','%'.$request->freelancerName.'%');
                $innerQuery->orwhere('last_name','like','%'.$request->freelancerName.'%');
            });
        }

        if (isset($request->categoryId)) {
            $subCategory = Category::where('parent_id',$request['categoryId'])->where('status','active')->get();
            if(count($subCategory) > 0){
                $catIds = $subCategory->map(function ($category) {
                    return $category->id;
                })->toArray();
                $skillsQuery->whereIn('category_id',$catIds);
                $userIds = UserSkill::whereIn('category_id',$catIds)->pluck('user_id');
                $query->whereIn('id',$userIds);
                foreach ($subCategory as $sCat){
                    $option .= '<option value="'.$sCat['id'].'">'.$sCat['name'].'</option>';
                }
                $data['option'] = $option;
            }
            $data['subcatChange'] = 1;
        }

        if (isset($request->subcategorId)) {
            $skillsQuery->where('category_id',$request->subcategorId);
            $userIds = UserSkill::where('category_id',$request->subcategorId)->pluck('user_id');
            $query->whereIn('id',$userIds);
            $data['subcatChange'] = 0;
        }

        if(isset($request->userSkill)){
            $data['selected_skill'] = $request->userSkill;
            $userIds = UserSkill::where('skill_id',$request->userSkill)->pluck('user_id');
            $query->whereIn('id',$userIds);
        }

        $data['users'] = $query->paginate('10');
        $data['skills'] = $skillsQuery->get();
        $data['content'] = view("frontend.freelancer.list",$data)->render();

        if(count($data['users']) > 0 ){
            $data['status'] = 1;
        }
        return $data;
    }
}
