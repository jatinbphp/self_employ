<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class SelfEmployeeController extends Controller
{
    public function index()
    {
        return view('frontend.home.home');
    }
    public function expert()
    {
        return view('frontend.experts.find-expert');
    }
    // public function jobs()
    // {
    //     return view('frontend.jobs.find-jobs');
    // }
    public function offers()
    {
        return view('frontend.offers.offer');
    }
    // public function posts()
    // {
    //     return view('frontend.posts.post-task');
    // }
    public function profile()
    {
        return view('frontend.profile.profile');
    }

    public function profile_settings()
    {
        return view('frontend.profile.profile-settings');
    }

    public function projects()
    {
        return view('frontend.projects.project');
    }
    public function projects_details()
    {
        return view('frontend.projects.project');
    }

    /**
     *
     * Pages Others
     */
    public function how_works()
    {
        return view('frontend.pages.how-work');
    }
    public function why_self_employee()
    {
        return view('frontend.pages.why-self-employee');
    }

    public function faqs()
    {
        return view('frontend.pages.faqs');
    }

    public function earnings()
    {
        return view('frontend.pages.earnings');
    }

    public function categories()
    {
        return view('frontend.categories.categories');
    }

    public function support(){
        $data['faqs'] = Faq::where('status', 'active')->get();
        return view('frontend.pages.supports',$data);
    }

    public function searchSupports(Request $request){
        $query = Faq::where('status','active')->select();
        if(isset($request->search)){
            $data['search'] = $request->search;
            $query->where('question','like','%'.$request->search.'%')->orwhere('answer','like','%'.$request->search.'%');
        }
        $data['faqs'] = $query->get();
        $data['content'] = view("frontend.pages.support_list",$data)->render();
        return $data;
    }

    public function contact()
    {
        return view('frontend.pages.supports');
        //return view('frontend.pages.contact');
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function terms()
    {
        return view('frontend.pages.terms');
    }



    /**
     * Auth Routes
     * Login, Register & Others
     */
    public function register()
    {
        return view('frontend.auth.login');
    }

    public function forgot()
    {
        return view('frontend.auth.login');
    }

    public function reset()
    {
        return view('frontend.auth.login');
    }

    public function verify()
    {
        return view('frontend.auth.login');
    }

    public function logout()
    {
        return redirect()->route('home.index');
    }

    public function admin()
    {
        return view('backend.home.index');
    }
    public function admin_profile()
    {
        return view('backend.profile.index');
    }
    public function admin_projects()
    {
        return view('backend.projects.index');
    }
    public function admin_user()
    {
        return view('backend.users.index');
    }
    public function admin_user_detail()
    {
        return view('backend.users.user-detail');
    }
    public function admin_login()
    {
        return view('backend.auth.signin');
    }
    public function admin_register()
    {
        return view('backend.auth.sign-up');
    }
    public function admin_reset()
    {
        return view('backend.auth.reset-password');
    }
    public function admin_new()
    {
        return view('backend.auth.new-password');
    }
    public function admin_2step()
    {
        return view('backend.auth.two-step');
    }
}
