<?php

namespace App\Http\Controllers\Frontend\Portfolio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Toastr;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Project;
use App\Models\Portfolio;
use App\Models\PortfolioImage;

class PortfolioController extends Controller
{
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        if (!is_null($user)) {
            $projects = Project::where('user_id', $user->id)->where('status', 'done')->get();
            $portfolios = Portfolio::where('user_id', $user->id)->get();
            return view('frontend.portfolio.index', ['user' => $user, 'projects'=> $projects, 'portfolios' => $portfolios]);
        } else {
            Toastr::error('User is not exist', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function store(Request $request) 
    {
        if ($request->isMethod('post')) {
            $validation = Validator::make($request->all(), [
                'name'          => 'required',
                'description'       => 'required',
            ]);

            if ($validation->fails()) {
                Toastr::error('Some Fileds are missing', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withErrors($validation)->withInput();
            }

            // dd($request->file('images'));

            if (!$request->hasFile('images')) {
                Toastr::error('You need add files', 'Error', ["positionClass" => "toast-top-right"]);
                return back()->withInput();
            }

            $data = [];

            $data['name'] = $request->name;
            $data['description'] = $request->description;
            $data['user_id'] = auth()->user()->id;
            $data['project_id'] = $request->project_id;

            $portfolio = Portfolio::create($data);

            if ($request->hasFile('images')) {
                $imageNames = multipleUploadImage($request->file('images'), storage_path('app/public/uploads/portfolio/portfolio_images/'));
                foreach ($imageNames as $img) {
                    $portfolioImage = PortfolioImage::create(['portfolio_id' => $portfolio->id, 'image' => $img]);
                }
            }

            if ($portfolio) {
                Toastr::success('Portfolio added Successfully', 'Success', ["positionClass" => "toast-top-right"]);
                return back();
            } else {
                Toastr::error('Oops! Something went wrong. Please try again', 'Error', ["positionClass" => "toast-top-right"]);
                return back();
            }
        }
    }

    public function approve(Request $request) 
    {
        $portfolio_id = $request->portfolio_id;
        $portfolio = Portfolio::where('id', $portfolio_id)->first();
        if (auth()->user()->id == $portfolio->getProjectId->getJobPost->user_id) {
            $portfolio_update = Portfolio::where('id', $portfolio_id)->update(['status' => 'approve']);
            if (!is_null($portfolio_update)) {
                Toastr::success('Portfolio approved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
                return back();
            } else {
                Toastr::error('Oops! Something went wrong. Please try again', 'Error', ["positionClass" => "toast-top-right"]);
                return back();
            }
        } else {
            Toastr::error('You do not have permission', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function reject(Request $request) 
    {
        $portfolio_id = $request->portfolio_id;
        $portfolio = Portfolio::where('id', $portfolio_id)->first();
        if (auth()->user()->id == $portfolio->getProjectId->getJobPost->user_id) {
            $portfolio_update = Portfolio::where('id', $portfolio_id)->update(['status' => 'rejected']);
            if (!is_null($portfolio_update)) {
                Toastr::success('Portfolio rejected Successfully', 'Success', ["positionClass" => "toast-top-right"]);
                return back();
            } else {
                Toastr::error('Oops! Something went wrong. Please try again', 'Error', ["positionClass" => "toast-top-right"]);
                return back();
            }
        } else {
            Toastr::error('You do not have permission', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }
}
