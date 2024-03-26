<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Toastr;
use Carbon\Carbon;

class AdminLoginController extends Controller
{
    /**
     * Auth Routes
     * Login, Register & Others
     */
    public function index()
    {
        return view('backend.auth.signin');
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
                User::where('email', $request->email)->update([
                    'last_login_at' => Carbon::now(),
                    'last_login_ip' => $request->getClientIp()
                ]);
                if ($user->role_id == 1) {
                    Toastr::success('Admin Login Successfully', 'Success', ["positionClass" => "toast-top-right"]);
                    return redirect()->route('page.admin');
                } else {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    Toastr::error('Login Failure! Have no permission for admin', 'Error', ["positionClass" => "toast-top-right"]);
                    return redirect()->route('auth.admin.login.form');
                }
            }
            return back()->withErrors(['error' => "Invalid Credential", 'emailid' => $request->email]);
        } else {
            return redirect()->route('auth.login.showform');
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
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.admin.login.form');
    }

    /**
     * Auth Routes
     * Login, Register & Others
     */
    public function change_password()
    {
        return view('backend.auth.change-password');
    }
    /**
     * Auth Routes
     * Login, Register & Others
     */
    public function changePasswordProcess(Request $request)
    {
        if ($request->isMethod('post')) {
            $validation = Validator::make($request->all(), [
                'current_password'    => 'required',
                'password' => 'required|min:8',
                'confirm-password' => 'required_with:password|same:password|min:8'
            ]);

            if ($validation->fails()) {
                Toastr::error('Credential are Invalid', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withErrors($validation)->withInput();
            }
            $getUser = User::where('id', auth()->user()->id)->first();
            if (Hash::check($request->current_password, $getUser->password)) {
                $user = User::where('id', auth()->user()->id)->update([
                    'password' => Hash::make($request->password)
                ]);

                if ($user) {
                    if (isset($request->logout_after) && $request->logout_after == 1) {
                        Auth::logout();
                        $request->session()->invalidate();
                        $request->session()->regenerateToken();
                        Toastr::success('Successfully! Password Changed', 'Success', ["positionClass" => "toast-top-right"]);
                        return redirect()->route('auth.admin.login.form');
                    } else {
                        Toastr::success('Successfully! Password Changed', 'Success', ["positionClass" => "toast-top-right"]);
                        return redirect()->route('page.admin');
                    }
                } else {
                    Toastr::error('Password Invalid! Failed change password', 'Error', ["positionClass" => "toast-top-right"]);
                    return redirect()->route('admin.auth.change-password');
                }
            }
            return back()->withErrors(['error' => "Invalid Password"]);
        } else {
            return redirect()->route('admin.auth.change-password');
        }
    }
}
