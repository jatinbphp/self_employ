<?php

namespace App\Http\Controllers\Admin\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostSkill;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminJobController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.jobs.index');
    }

    public function getJobs(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::where('status', 'active')->with('getPostCategory', 'getJobPoster', 'getPostImages', 'getBudgetTypes', 'getPostSkills')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show(Request $request, $id)
    {
        $user = Post::where('id', $id)->first();
        return view('backend.jobs.job-detail', ['user' => $user]);
    }

    public function delete(Request $request)
    {
        $post = Post::where('id', $request->id)->firstorfail()->delete();
        if ($post) {
            PostImage::where('post_id', $request->id)->delete();
            PostSkill::where('post_id', $request->id)->delete();
            return response(['success' => true], 200);
        } else {
            return response(['error' => false], 200);
        }
    }
}
