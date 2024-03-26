<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Mail\Auth\ForgotPassword;
use App\Models\LoginDetailActivity;
use App\Models\PasswordReset;
use App\Models\UserLoginHistory;
use App\Models\User;

use Carbon\Carbon;
use BrowserDetect;
use Illuminate\Support\Facades\Hash;
use Toastr;
use Location;

class LoginController extends Controller
{
    /**
     * Auth Routes
     * Login, Register & Others
     */
    public function index()
    {
        return view('frontend.auth.login');
    }

    /**
     * Log the user in of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $validation = Validator::make($request->all(), [
                'email'    => 'required|email',
                'password' => 'required'
            ]);

            if ($validation->fails()) {
                Toastr::error('Credential are Invalid', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withErrors($validation)->withInput();
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
                $user = Auth::user();
                $location = Location::get($request->ip);
                if ($location != false) {
                    UserLoginHistory::create([
                        'user_id' => $user->id,
                        'country' => $location->countryName,
                        'country_code' => $location->countryCode,
                        'city' => $location->cityName,
                        'region_name' => $location->regionName,
                        'browser' => BrowserDetect::browserFamily() . '-' . BrowserDetect::platformName(),
                        'last_login_ip' => $request->getClientIp(),
                        'last_login_at' => Carbon::now(),
                        'status' => 'active',
                    ]);
                }

                User::where('email', $request->email)->update([
                    'last_login_at' => Carbon::now(),
                    'last_login_ip' => $request->getClientIp()
                ]);

                LoginDetailActivity::create([
                    'user_id' => $user->id,
                    'login_details_id' => md5(uniqid() . mt_rand()),
                    'last_activity' => Carbon::now()
                ]);

                if ($user->role_id == 2) {
                    if($user->is_deactivate == 1){
                        //Session::flush();
                        Auth::logout();
                        Toastr::error('Please contact to admin.', 'Account Deactivated!', ["positionClass" => "toast-top-right"]);
                        return redirect()->back();
                    }else{
                        Toastr::success('Login Successfully', 'Success', ["positionClass" => "toast-top-right"]);
                        return redirect()->route('jobs.index');
                        return redirect()->route('profile.profile_settings.index');
                    }
                } else {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    Toastr::error('Login Failure', 'Error', ["positionClass" => "toast-top-right"]);
                    return redirect()->route('auth.login.showform');
                }
            }
            return back()->withErrors(['error' => "Invalid Credential", 'emailid' => $request->email]);
        } else {
            return redirect()->route('auth.login.showform');
        }
    }

    /**
     * Log the user in of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login_modal(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json(['success' => false, 'message' => 'Credential are Invalid']);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
            $user = Auth::user();
            $location = Location::get($request->ip);
            if ($location != false) {
                UserLoginHistory::create([
                    'user_id' => $user->id,
                    'country' => $location->countryName,
                    'country_code' => $location->countryCode,
                    'city' => $location->cityName,
                    'region_name' => $location->regionName,
                    'browser' => BrowserDetect::browserFamily() . '-' . BrowserDetect::platformName(),
                    'last_login_ip' => $request->getClientIp(),
                    'last_login_at' => Carbon::now(),
                    'status' => 'active',
                ]);
            }

            User::where('email', $request->email)->update([
                'last_login_at' => Carbon::now(),
                'last_login_ip' => $request->getClientIp()
            ]);

            if ($user->role_id == 2) {
                return response()->json(['success' => true, 'user' => $user, 'message' => 'Successfully Login']);
                return redirect()->route('jobs.index');
                return redirect()->route('profile.profile_settings.index');
            } else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return response()->json(['success' => false, 'message' => 'Credential are Invalid']);
            }
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        UserLoginHistory::where('user_id', auth()->user()->id)->update([
            'status' => 'logout',
            'logout_at' => Carbon::now()
        ]);

        if(LoginDetailActivity::where('user_id', Auth::user()->id)->exists()){
            LoginDetailActivity::where('user_id', Auth::user()->id)->delete();
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    /**
     * Forgot the password in of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forgot()
    {
        return view('frontend.auth.forgot-password');
    }

    /**
     * Process Forgot Password the user in of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forgot_password(Request $request)
    {
        if ($request->isMethod('post')) {
            $validation = Validator::make($request->all(), [
                'email'    => 'required|email',
            ]);

            if ($validation->fails()) {
                Toastr::error('Invalid Email', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withErrors($validation)->withInput();
            }

            $user = User::where('email', $request->email)->first();
            if ($user) {
                $password_reset = PasswordReset::create([
                    'token' => Hash::make(generate_token()),
                    'email' => $request->email,
                    'user_id' => $user->id,
                    'otp_code' => generate_otp()
                ]);
                $password_reset['route'] = route('auth.reset.showform', ['token=' . $password_reset->token . '&otp=' . $password_reset->otp_code]);
                Toastr::success('Email Sent successfully', 'Success', ["positionClass" => "toast-top-right"]);
                Mail::to($request->email)->send(new ForgotPassword($password_reset));
                return redirect(route('auth.thankyou.showform', ['email' => $request->email]));
            } else {
                Toastr::error('Email does not exists', 'Error', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }
        }
    }

    public function thankyou(Request $request)
    {

        return view('frontend.auth.thank-forgot-password', ['email' => $request->email]);
    }

    public function reset(Request $request)
    {
        return view('frontend.auth.reset-password');
    }

    public function reset_password(Request $request)
    {
        if ($request->isMethod('post')) {

            $validation = Validator::make($request->all(), [
                'password'    => 'required|min:6',
                'confirm_password'    => 'required_with:password|min:6|same:password',
            ]);

            if ($validation->fails()) {
                Toastr::error('Password does not match', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withErrors($validation)->withInput();
            }

            $password_reset = PasswordReset::where('token', $request->token)->where('otp_code', $request->otp)->first();

            if ($password_reset) {
                $user = User::where('email', $password_reset->email)->where('id', $password_reset->user_id)->update([
                    'password' => Hash::make($request->password)
                ]);
                if ($user) {
                    PasswordReset::where('token', $request->token)->where('otp_code', $request->otp)->update([
                        'status' => 'used'
                    ]);
                }
                Toastr::success('Password has been reset successfully', 'Success', ["positionClass" => "toast-top-right"]);
                return redirect()->route('auth.login.showform');
            } else {
                Toastr::error('Oops! Something went wrong', 'Error', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }
        }
    }

    public function signup()
    {
        return view('frontend.auth.register');
    }

    public function createUser(Request $request)
    {
        if ($request->isMethod('post')) {

            $validation_password = Validator::make($request->all(), [
                'password'    => 'required|min:6',
                'confirm_password'    => 'required_with:password|min:6|same:password'
            ]);

            $validation_username = Validator::make($request->all(), [
                'username' => 'required'
            ]);

            $validation_email = Validator::make($request->all(), [
                'email' => 'required|email'
            ]);

            $validation_name = Validator::make($request->all(), [
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:3'
            ]);

            if ($validation_password->fails()) {
                Toastr::error('Password does not match', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withErrors($validation_password)->withInput();
            }

            if ($validation_username->fails()) {
                Toastr::error('Please input username', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withErrors($validation_username)->withInput();
            }

            if ($validation_email->fails()) {
                Toastr::error('Please input correct email', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withErrors($validation_email)->withInput();
            }

            if ($validation_name->fails()) {
                Toastr::error('Please input name', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withErrors($validation_name)->withInput();
            }

            $user_email = User::where('email', $request->email)->first();
            $user_username = User::where('username', $request->uaername)->first();

            if ($user_email) {
                Toastr::error('Email is already exist', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withErrors($validation_email)->withInput();
            }

            if ($user_username) {
                Toastr::error('UserName is already exist', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withErrors($validation_username)->withInput();
            }

            User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'role_id' => 2,
                'status'     => 'active',
                'language_id' => 1,
                'category_id' => 1,
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                Toastr::success('Registered successfully', 'Success', ["positionClass" => "toast-top-right"]);
                return redirect()->route('jobs.index');
            } else {
                Toastr::error('Oops! Something went wrong', 'Error', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
            }
        }
    }
}
