<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
use DataTables;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.categories.index');
    }
    public function getCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::where('parent_id',0)->get();

            return Datatables::of($data)
                ->addIndexColumn()
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
        return view('backend.categories.add');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'    => 'required',
            'status' => 'required|not_in:0',
        ]);

        if ($validation->fails()) {
            Toastr::error('Credential are Invalid', 'Error', ["positionClass" => "toast-top-right"]);
            return back()->withErrors($validation)->withInput();
        }

        $category = Category::create([
            'name' => ucfirst($request->name),
            'status' => $request->status,
            'image' => 'default.png',
        ]);
        if ($category) {
            Toastr::success('Succefully! Category Added', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.categories');
        } else {
            Toastr::error('Something Went Wrong', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return view('backend.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name'    => 'required',
            'status' => 'required|not_in:0',
        ]);

        if ($validation->fails()) {
            Toastr::error('Credential are Invalid', 'Error', ["positionClass" => "toast-top-right"]);
            return back()->withErrors($validation)->withInput();
        }
        $category = Category::where('id', $id)->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        if ($category) {
            Toastr::success('Succefully! Category Updated', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.categories');
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
        $category = Category::where('id', $request->id)->firstorfail()->delete();
        if ($category) {
            CategorySkill::where('category_id', $request->id)->delete();
            return response(['success' => true], 200);
        } else {
            return response(['error' => false], 200);
        }
    }
}
