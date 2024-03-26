<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.users.index');
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::whereNotIn('role_id', [1])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    $active = $row['status'] == 'active' ? 'selected' : '';
                    $inactive = $row['status'] == 'inactive' ? 'selected' : '';
                    $status = '<select name="status" class="form-select form-select-solid" onchange="changeStatus(this.value, '.$row['id'].')">
                                    <option value="active" '.$active.'>Active</option>
                                    <option value="inactive" '.$inactive.'>Inactive</option>
                                    </select>';
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }
    }

    public function show(Request $request, $id)
    {
        $user = User::where('id', $id)->with('getRoles', 'getJobPosted', 'getUserLoginHistory')->first();

        return view('backend.users.user-detail', ['user' => $user]);
    }

    public function show_projects(Request $request, $id)
    {
        $per_page = isset($request->per_page) ? $request->per_page : 6;
        $posts = Post::where('status', 'active')->where('user_id', $id)->with('getPostCategory', 'getJobPoster', 'getPostImages', 'getBudgetTypes', 'getPostSkills')->paginate($per_page);
        $post_counts = Post::where('status', 'active')->where('user_id', $id)->count();
        $user = User::where('id', $id)->first();
        $posts_completed = [];
        $posts_in_progress = [];
        return view('backend.users.user-projects', ['posts' => $posts, 'user' => $user, 'per_page' => $per_page, 'post_counts' => $post_counts, 'posts_in_progress' => $posts_in_progress, 'posts_completed' => $posts_completed]);
    }

    public function delete(Request $request)
    {
        $user = User::where('id', $request->id)->firstorfail()->delete();
        if ($user) {
            return response(['success' => true], 200);
        } else {
            return response(['error' => false], 200);
        }
    }

    public function updateStatus(Request $request){
        $user = User::where('id',$request['user_id'])->first();
        if(!empty($user)){
            $input['is_deactivate'] = $request['status'] == 'active' ? 0 : 1;
            $input['status'] = $request['status'];
            $user->update($input);
            return 1;
        }else{
            return 0;
        }
    }
}
