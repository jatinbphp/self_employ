<?php

namespace App\Http\Controllers\Frontend\Team;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PusherController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Toastr;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Team;
use App\Models\TeamUser;
use App\Models\Invite;
use App\Models\Post;
use App\Models\Notification;
use DB;

class TeamController extends Controller
{
    public function index($id)
    {
        $team = Team::where('id', $id)->where('deleted', null)->first();
        $team_users = TeamUser::all();
        $this_team = TeamUser::where('team_id', $id)->get();
        $already_members = [];
        foreach($team_users as $team_user) {

            if (is_null($team_user->getTeam->deleted))  array_push($already_members, $team_user->user_id);
        }
        if (Auth::check()) {
            array_push($already_members, Auth::user()->id);
            $users = User::where('role_id', 2)->whereNotIn('id', $already_members)->get();
        }
        else {
            $users = User::where('role_id', 2)->paginate(5);
        }

        if (!is_null($team)) {
            $invited_user = Invite::where('team_id', $team->id)->where('user_id', Auth::user()->id)->where('status', 'pending')->first();

            return view('frontend.projects.view-team-profile', [ 'team'=> $team, 'users'=>$users, 'invited'=>$invited_user, 'team_users'=>$this_team]);
        } else {
            Toastr::error('Team is not exist', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect('/');
        }
    }

    public function invite(Request $request)
    {   
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();
        $post = Post::all();
        if (!is_null($user)){
            $team = Team::where('owner_id', Auth::user()->id)->where('deleted', null)->first();

            $invite = Invite::where('user_id', $user_id)->whereIn('status', ['pending'])->where('team_id', $team->id)->get();
            if (!is_null($team) && count($invite) == 0) {
                $data['user_id'] = $user_id;
                $data['team_id'] = $team->id;
                $data['role'] = $request->role;
                
                $team_user = Invite::create($data);

                $pusherController = new PusherController();

                $nofification_match = [];
                $nofification_match['post_id'] = $post[0]->id;
                $nofification_match['from_user'] = auth()->user()->id;
                $nofification_match['content'] = $team->name." invited you as a ".$request->role;
                $nofification_match['to'] = $user_id;
                $nofification_match['from_team_id'] = $team->id;

                $nofification_match['type'] = 2;
                $notification = Notification::create($nofification_match);

                // if ($request->hasfile('images')) {
                    $nofification_match['post_image'] = $team->profile_image;
                // }
                $nofification_match['from_user_name'] = $team->name;
                
                $nofification_match['post_date'] = $notification->date_time_str;
                $pusherController->notify($nofification_match);



                Toastr::success('You invited a team member', 'Success', ["positionClass" => "toast-top-right"]);
                return response()->json(['success'=>true, 'message'=>"You invited a new member!", 'url'=>url('/team/profile/'.$team->id)]);
            } else {
                return response()->json(['success'=>false, 'message'=>"Something went wrong!"]);
            }
            
        } else {
            return response()->json(['success'=>false, 'message'=>'You invited invalid user!']);
        }
    }

    public function search(Request $request) {
        $name = $request->name;
        $users = User::whereRaw("concat(first_name, ' ', last_name) LIKE '%".$name."%'")->where('role_id', '2')->where('id', '!=' , Auth::user()->id)->get();
        return response()->json(['success'=>true, 'users'=> $users]);
    }

    public function delete(Request $request) {
        $team = Team::where('owner_id', Auth::user()->id)->where('deleted', null)->first();
        $post = Post::all();
        if (!is_null($team)) {
            $team->deleted = "1";
            $team->update(array('deleted'=>'1'));
            $users = TeamUser::where('team_id', $team->id)->get();
            $pusherController = new PusherController();
            foreach ($users as $user) {
                $nofification_match = [];
                $nofification_match['post_id'] = $post[0]->id;
                $nofification_match['from_user'] = auth()->user()->id;
                $nofification_match['content'] = $team->name." have been deleted where you worked as ".$user->role;
                $nofification_match['to'] = $user->user_id;
                $nofification_match['from_team_id'] = $team->id;

                $nofification_match['type'] = 2;
                $notification = Notification::create($nofification_match);

                // if ($request->hasfile('images')) {
                    $nofification_match['post_image'] = $team->profile_image;
                // }
                $nofification_match['from_user_name'] = $team->name;
                
                $nofification_match['post_date'] = $notification->date_time_str;
                $pusherController->notify($nofification_match);
            }
            Toastr::success('You deleted your team.', 'Success', ["positionClass" => "toast-top-right"]);
            return response()->json(['success'=>true, 'url'=>url('/user/profile/'.Auth::user()->id)]);
        } else {
            return response()->json(['success'=>false, 'message'=>"Invalid team"]);
        }
    }

    public function name_update(Request $request) {
        $team = Team::where('owner_id', Auth::user()->id)->first();
        if (!is_null($team)) {
            if ($request->has('name')) {
                Team::where('owner_id', Auth::user()->id)->update(['name' => $request->name]);
                Toastr::success('Team Profile Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            } else {
                Toastr::error('Team Profile Update Failed', 'Error', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }
        } else {
            Toastr::error('Team profile update failed', 'Error', ["positionClass" => "toast-top-right"]);
            redirect()->back();
        }
        
    }

    public function accept (Request $request) 
    {
        $invite = Invite::where('id', $request->invite_id)->where('status', 'pending')->first();
        $team = Team::where('id', $invite->team_id)->first();
        $post = Post::all();
        if (!is_null($invite)) {
            if ($invite->user_id == Auth::user()->id) {
                $data['user_id'] = Auth::user()->id;
                $data['role'] = $invite->role;
                $data['team_id'] = $invite->team_id;
                TeamUser::create($data);
                $invite->update(array('status'=>'accepted'));

                $pusherController = new PusherController();

                $nofification_match = [];
                $nofification_match['post_id'] = $post[0]->id;
                $nofification_match['from_user'] = auth()->user()->id;
                $nofification_match['content'] = auth()->user()->first_name." ".auth()->user()->last_name." accepted your invite as ".$invite->role;
                $nofification_match['to'] = $team->owner_id;
                $nofification_match['from_team_id'] = $team->id;

                $nofification_match['type'] = 2;
                $notification = Notification::create($nofification_match);
                $nofification_match['post_image'] = auth()->user()->profile_image;
                $nofification_match['from_user_name'] = auth()->user()->first_name." ".auth()->user()->last_name;
                
                $nofification_match['post_date'] = $notification->date_time_str;
                $pusherController->notify($nofification_match);


                return response()->json(['success'=>true, 'message'=>"Accepted", 'url'=>url('/team/profile/'.$invite->team_id)]);
            } else {
                 return response()->json(['success'=>false, 'message'=>"Permission Denied"]);
            }
        } else {
            return response()->json(['success'=>false, 'message'=>"Invalid Invitation"]);
        }
    }

    public function reject(Request $request) 
    {
        $invite = Invite::where('id', $request->invite_id)->where('status', 'pending')->first();
        $team = Team::where('id', $invite->team_id)->first();
        $post = Post::all();
        if (!is_null($invite)) {
            if ($invite->user_id == Auth::user()->id) {
                $pusherController = new PusherController();

                $nofification_match = [];
                $nofification_match['post_id'] = $post[0]->id;
                $nofification_match['from_user'] = auth()->user()->id;
                $nofification_match['content'] = auth()->user()->first_name." ".auth()->user()->last_name." rejected your invite as ".$invite->role;
                $nofification_match['to'] = $team->owner_id;
                $nofification_match['from_team_id'] = $team->id;

                $nofification_match['type'] = 2;
                $notification = Notification::create($nofification_match);
                $nofification_match['post_image'] = auth()->user()->profile_image;
                $nofification_match['from_user_name'] = auth()->user()->first_name." ".auth()->user()->last_name;
                
                $nofification_match['post_date'] = $notification->date_time_str;
                $pusherController->notify($nofification_match);

                $invite->update(array('status'=>'rejected'));
                return response()->json(['success'=>true, 'message'=>"Rejected", 'url'=>url('/team/profile/'.$invite->team_id)]);
            } else {
                 return response()->json(['success'=>false, 'message'=>"Permission Denied"]);
            }
        } else {
            return response()->json(['success'=>false, 'message'=>"Invalid Invitation"]);
        }
    }

    public function remove(Request $request) {
        $user = TeamUser::where('user_id', $request->user_id)->first();
        $team_id = $user->team_id;
        $team = Team::where('owner_id', auth()->user()->id)->where('deleted', null)->first();
        $post = Post::all();

        if (!is_null($user)) {
            $user->delete();
            $pusherController = new PusherController();

            $nofification_match = [];
            $nofification_match['post_id'] = $post[0]->id;
            $nofification_match['from_user'] = auth()->user()->id;
            $nofification_match['content'] = "You are removed from ".$team->name." as ".$user->role;
            $nofification_match['to'] = $request->user_id;
            $nofification_match['from_team_id'] = $team->id;

            $nofification_match['type'] = 2;
            $notification = Notification::create($nofification_match);

            // if ($request->hasfile('images')) {
                $nofification_match['post_image'] = auth()->user()->profile_image;
            // }
            $nofification_match['from_user_name'] = auth()->user()->first_name." ".auth()->user()->last_name;
            
            $nofification_match['post_date'] = $notification->date_time_str;
            $pusherController->notify($nofification_match);

            return response()->json(['success'=>true, 'url'=>url('/team/profile/'.$team_id)]);
            Toastr::success('You removed a team member', 'Success', ["positionClass" => "toast-top-right"]);
        } else {
            return response()->json(['success'=>false, 'message'=>"Invalid team"]);
        }
    }

    public function leave(Request $request) {
        $user = TeamUser::where('user_id', $request->user_id)->first();
        $team = Team::where('id', $request->team_id)->first();
        $post = Post::all();

        if (!is_null($user)) {
            

            $pusherController = new PusherController();

            $nofification_match = [];
            $nofification_match['post_id'] = $post[0]->id;
            $nofification_match['from_user'] = auth()->user()->id;
            $nofification_match['content'] = auth()->user()->first_name." ".auth()->user()->last_name."left your team as".$user->role;
            $nofification_match['to'] = $team->owner_id;
            $nofification_match['from_team_id'] = $team->id;

            $nofification_match['type'] = 2;
            $notification = Notification::create($nofification_match);

            // if ($request->hasfile('images')) {
                $nofification_match['post_image'] = auth()->user()->profile_image;
            // }
            $nofification_match['from_user_name'] = auth()->user()->first_name." ".auth()->user()->last_name;
            
            $nofification_match['post_date'] = $notification->date_time_str;
            $pusherController->notify($nofification_match);
            $user->delete();
            return response()->json(['success'=>true, 'url'=>url('/user/profile/'.$request->user_id)]);
            Toastr::success('You removed a team member', 'Success', ["positionClass" => "toast-top-right"]);
        } else {
            return response()->json(['success'=>false, 'message'=>"Invalid team"]);
        }
    }

    public function store(Request $request) 
    {
        if ($request->isMethod('post')) {
            $validation = Validator::make($request->all(), [
                'name'          => 'required'
            ]);

            if ($validation->fails()) {
                Toastr::error('Some Fileds are missing', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withErrors($validation)->withInput();
            }

            // dd($request->file('images'));

            // if (!$request->hasFile('images')) {
            //     Toastr::error('You need add your team logo', 'Error', ["positionClass" => "toast-top-right"]);
            //     return back()->withInput();
            // }

            $data = [];

            $data['name'] = $request->name;
            $data['owner_id'] = auth()->user()->id;
            $data['project_id'] = $request->project_id;
           

            // if ($request->hasFile('images')) {
            //     $imageNames = multipleUploadImage($request->file('images'), storage_path('app/public/uploads/user/user_profile/'));
            //     foreach ($imageNames as $img) {
            //         $data['image'] = $img;
            //     }
            // }
            $old_team = Team::where('owner_id', auth()->user()->id)->where('deleted', null)->get();
            $team = Team::create($data);

             
            if ($team && count($old_team)<1) {
                Toastr::success('Your Team created Successfully', 'Success', ["positionClass" => "toast-top-right"]);
                return back();
            } else {

                Toastr::error('Oops! Something went wrong. Please try again', 'Error', ["positionClass" => "toast-top-right"]);
                return back();
            }
        }
    }
}
