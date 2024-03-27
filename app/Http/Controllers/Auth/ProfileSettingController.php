<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySkill;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Project;
use App\Models\Team;
use App\Models\UserCards;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSkill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Stripe\Token;
use Toastr;
use Illuminate\Support\Facades\Validator;

class ProfileSettingController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $data['user'] = User::where('id', $id)->first();
        $data['team'] = Team::where('owner_id', $id)->where('deleted', null)->first();

        $data['team_member'] = DB::table('team_users')
            ->join('teams', 'team_users.team_id', '=', 'teams.id')
            ->select('team_users.*', 'teams.*')
            ->where('teams.deleted', null)
            ->where('team_users.user_id', $id)->get();

        if (!is_null($data['user'] )) {
            $data['projects'] = Project::where('user_id', $id)->where('status', 'done')->get();
            $data['posts'] = Post::where('user_id', $id)->get();
            $data['portfolios'] = Portfolio::with('getProjectId')->where('user_id', $id)->get();
            $data['userSkills'] = UserSkill::where('user_id', $id)->with('getSkills')->get();
            $data['allSkills'] = CategorySkill::all();
            $data['userCards'] = UserCards::where('user_id', $id)->get();
            return view('frontend.profile.profile-settings', $data);
        }else {
            Toastr::error('User is not exist', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 2, 'errors' => $validator->errors()], 200);
        }

        $user = User::where('id', auth()->user()->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'country' => $request->country,
            'language_id' => $request->language_id,
            // 'about' => $request->about,
            'company_name' => $request->company_name,
            'designation' => $request->designation,
            // 'category_id' => $request->category,
        ]);

        if ($user) {
            // if (!is_null($request->skills)) {
            //     UserSkill::where('user_id', auth()->user()->id)->delete();
            //     foreach ($request->skills as $skill) {
            //         UserSkill::create([
            //             'user_id' => auth()->user()->id,
            //             'category_id' => $request->category,
            //             'skill_id' => $skill
            //         ]);
            //     }
            // }
            $data['status'] = 1;
            $data['message'] = 'Profile Update Successfully';
            //Toastr::success('', 'Success', ["positionClass" => "toast-top-right"]);
            //return redirect()->route('user.view.profile', ['id'=>auth()->user()->id]);
        } else {
            $data['status'] = 0;
            $data['message'] = 'Profile Update Failed';
            //Toastr::error('Profile Update Failed', 'Error', ["positionClass" => "toast-top-right"]);
            //return redirect()->route('profile.profile_settings.index');
        }
        return $data;
    }

    public function coverUpdate(Request $request)
    {
        if ($request->has('cover')) {
            $user_cover = uploadImage($request->cover, storage_path('app/public/uploads/user/user_cover/'));
            User::where('id', auth()->user()->id)->update(['cover' => $user_cover]);
            Toastr::success('Profile Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        } else {
            Toastr::error('Profile Setting Update Failed', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }

    public function aboutUpdate(Request $request)
    {
        if ($request->has('about')) {
            User::where('id', auth()->user()->id)->update(['about' => $request->about]);
            Toastr::success('Profile Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        } else {
            Toastr::error('Profile Update Failed', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }

    public function skillUpdate(Request $request)
    {
        if ($request->has('skills')) {
            /*$user = User::where('id', auth()->user()->id)->update([
                'category_id' => $request->category,
                'subcategory_id' => $request->sub_category,
            ]);*/
            $user = User::where('id', auth()->user()->id)->first();
            if ($user) {
                if (!is_null($request->skills)) {
                    UserSkill::where('user_id', auth()->user()->id)->delete();
                    foreach ($request->skills as $skill) {
                        $catSkill = CategorySkill::where('id',$skill)->first();
                        UserSkill::create([
                            'user_id' => auth()->user()->id,
                            'category_id' => $catSkill->category_id,
                            'skill_id' => $skill
                        ]);
                    }
                }

                Toastr::success('Profile Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            } else {
                Toastr::error('Profile Update Failed', 'Error', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }
        } else {
            Toastr::error('Profile Update Failed', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

    }

    public function imageUpdate(Request $request)
    {
        if ($request->has('image')) {
            $user_image = uploadImage($request->image, storage_path('app/public/uploads/user/user_profile/'));
            User::where('id', auth()->user()->id)->update(['image' => $user_image]);
            Toastr::success('Profile Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        } else {
            Toastr::error('Profile Setting Update Failed', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }

    public function getUserSkills(Request $request)
    {

        $skills = CategorySkill::where('category_id', $request->category_id)->get();
        $userSkills = UserSkill::where('user_id', $request->user_id)->get();
        $userSkill = [];
        foreach ($userSkills as $skills) {
            $userSkill[] = $skills->skill_id;
        }

        return response()->json(['success' => true, 'skills' => $skills]);
    }

    public function changePassword(Request $request){
        dd($request->all());
    }

    public function emailUpdate(Request $request){
        $uid = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,'.$uid.',id',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 2, 'errors' => $validator->errors()], 200);
        }

        $user = User::where('id',$uid)->first();
        if(empty($user)){
            $msg = 'User Not found';
            $status = 0;
        }else{
            if(Hash::check($request['password'], $user['password'])){
                $input['email'] = $request['email'];
                $user->update($input);
                $msg = 'Email Updated Successfully';
                $status = 1;
            }else{
                $msg = 'Password Is Incorrect';
                $status = 0;
            }
        }
        $data['message'] = $msg;
        $data['status'] = $status;
        return $data;
    }

    public function passwordUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 2, 'errors' => $validator->errors()], 200);
        }

        $uid = Auth::user()->id;
        $user = User::where('id',$uid)->first();
        if(empty($user)){
            $msg = 'User Not found';
            $status = 0;
        }else{
            if(Hash::check($request['old_password'], $user['password'])){
                $input['password'] = $request['password'];
                $user->update($input);
                $msg = 'Password Updated Successfully';
                $status = 1;
            }else{
                $msg = 'Old Password Is Incorrect';
                $status = 0;
            }
        }
        $data['message'] = $msg;
        $data['status'] = $status;
        return $data;
    }

    public function addCard(Request $request){
        $uid = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'card_number' => 'required',
            'cvv' => 'required',
            'expiry_month' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 2, 'errors' => $validator->errors()], 200);
        }

        $exp_date = explode('/',$request['expiry_month']);
        $sKey = env('STRIPE_KEY');
        \Stripe\Stripe::setApiKey($sKey);
        try{
            $response = \Stripe\Token::create(array(
                "card" => array(
                    'number' => $request['card_number'],
                    'cvc' => $request['cvv'],
                    'exp_month' => $exp_date[0],
                    'exp_year' => $exp_date[1],
                )
            ));

            $input['user_id'] = $uid;
            $input['card_number'] = $request['card_number'];
            $input['expiry_month'] = $request['expiry_month'];
            $input['token'] = $response['id'];
            $input['status'] = 'authenticate';
            $card = UserCards::create($input);

            if(!empty($card)){
                $data['status'] = 1;
                $card['card_number'] = get_card_number($card['card_number']);
                $data['card'] = $card;
                $data['message'] = 'Your card is authenticated successfully';
            }else{
                $data['status'] = 0;
                $data['message'] = 'Something is wrong! Please try again';
            }
            return $data;
        }catch(\Exception $e){
            $data['status'] = 0;
            $data['message'] = $e->getMessage();
            return $data;
        }
    }

    public function deleteCard(Request $request)
    {
        $card = UserCards::where('user_id',Auth::user()->id)->where('id',$request['cId'])->first();
        if(!empty($card)){
            $card->delete();
            return 1;
        }else{
            return 0;
        }
    }

    public function deactivate(Request $request){
        $user = User::where('id',Auth::user()->id)->first();
        if(!empty($user)){
            $input['is_deactivate'] = 1;
            $input['status'] = 'active';
            $user->update($input);
            return 1;
        }else{
            return 0;
        }
    }
}
