<?php

namespace App\Http\Controllers\Admin\Faq;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toastr;
use DataTables;

class AdminFaqController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.faqs.index');
    }

    public function getFaqs(Request $request)
    {
        if ($request->ajax()) {
            //$data = Faq::all();
            $data = Faq::all();

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
        return view('backend.faqs.add');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'question'    => 'required',
            'answer'    => 'required',
        ]);

        if ($validation->fails()) {
            Toastr::error('Oops! Something is missing', 'Error', ["positionClass" => "toast-top-right"]);
            return back()->withErrors($validation)->withInput();
        }

        $faqs = Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
             'status' => $request->status,
        ]);
        if ($faqs) {
            Toastr::success("Succefully! FAQ's Added", 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.faqs');
        } else {
            Toastr::error('Something Went Wrong', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function edit($id)
    {
        $faqs = Faq::where('id', $id)->first();
        return view('backend.faqs.edit', ['faqs' => $faqs]);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'question'    => 'required',
            'answer'    => 'required',
        ]);

        if ($validation->fails()) {
            Toastr::error('Oops! Something is missing', 'Error', ["positionClass" => "toast-top-right"]);
            return back()->withErrors($validation)->withInput();
        }
        $faqs = Faq::where('id', $id)->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'status' => $request->status,
        ]);
        if ($faqs) {
            Toastr::success("Succefully! FAQ's Updated", 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.faqs');
        } else {
            Toastr::error('Something Went Wrong', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function show(Request $request, $id)
    {
        $faqs = Faq::where('id', $id)->with('getSkills')->first();
        return view('backend.users.user-detail', ['faqs' => $faqs]);
    }

    public function delete(Request $request)
    {
        $faqs = Faq::where('id', $request->id)->firstorfail()->delete();
        if ($faqs) {
            return response(['success' => true], 200);
        } else {
            return response(['error' => false], 200);
        }
    }
}
