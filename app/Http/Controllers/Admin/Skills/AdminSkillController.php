<?php

namespace App\Http\Controllers\Admin\Skills;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
use DataTables;

class AdminSkillController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.skills.index');
    }

    public function getSkills(Request $request)
    {
        if ($request->ajax()) {
            $data = CategorySkill::with('getCategory')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('category_id', function ($row) {
                    return $row->getCategory->name;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        $data['category'] = Category::where('parent_id',0)->where('status','active')->select('id','name')->get();
        return view('backend.skills.add', $data);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'main_category' => 'required|not_in:0',
            'category_id' => 'required|not_in:0',
            'name.*'    => 'required',
        ]);

        if ($validation->fails()) {
            Toastr::error('Some Fields are required *', 'Error', ["positionClass" => "toast-top-right"]);
            return back()->withErrors($validation)->withInput();
        }
        $categorySkill = [];
        foreach ($request->name as $name) {
            $categorySkill[] = CategorySkill::create([
                'name' => ucfirst($name),
                'category_id' => $request->category_id,
            ]);
        }
        if ($categorySkill) {
            Toastr::success('Succefully! Skills Added', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.skills');
        } else {
            Toastr::error('Something Went Wrong', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function edit($id)
    {
        $data['categorySkills'] = CategorySkill::with('getCategory')->where('id', $id)->first();
        $data['category'] = Category::where('parent_id',0)->where('status','active')->select('id','name')->get();
        $data['subCategory'] = Category::where('parent_id',$data['categorySkills']['getCategory']['parent_id'])->where('status','active')->select('id','name')->get();
        return view('backend.skills.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'category_id' => 'required|not_in:0',
            'name'    => 'required',
        ]);

        if ($validation->fails()) {
            Toastr::error('Some Fields are required *', 'Error', ["positionClass" => "toast-top-right"]);
            return back()->withErrors($validation)->withInput();
        }
        $categorySkill = CategorySkill::where('id',$id)->update([
            'name' => ucfirst($request->name),
            'category_id' => $request->category_id,
        ]);
        if ($categorySkill) {
            Toastr::success('Succefully! Category Updated', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.skills');
        } else {
            Toastr::error('Something Went Wrong', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function show(Request $request, $id)
    {
        $user = Category::where('id', $id)->with('getSkills')->first();
        return view('backend.users.user-detail', ['user' => $user]);
    }

    public function delete(Request $request)
    {
        $categorySkill = CategorySkill::where('id', $request->id)->firstorfail()->delete();
        if ($categorySkill) {
            return response(['success' => true], 200);
        } else {
            return response(['error' => false], 200);
        }
    }

    public function getSubCategroy(Request $request){
        $subCategory = Category::where('parent_id',$request['category'])->where('status','active')->select('id','parent_id','name')->get();
        $data['status'] = 0;
        $options = '';
        if(count($subCategory) > 0){
            $options .= '<option value="">Please Select Subcategory</option>';
            foreach ($subCategory as  $list){
                $options .= '<option value="'.$list['id'].'">'.$list['name'].'</option>';
            }
            $data['option'] = $options;
            $data['status'] = 1;
        }
        return $data;
    }
}
