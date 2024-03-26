<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AcceptOffer;
use App\Models\Post;
use App\Models\UserSkill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $userSkills = UserSkill::where('user_id', auth()->user()->id)->with('getSkills')->get();
        return view('frontend.profile.profile', ['userSkills' => $userSkills]);
    }

    public function getProjects(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->id)) {
                $hireProjects = AcceptOffer::where('user_id', $request->id)->with('getProject')->get();
            } else {
                $hireProjects = AcceptOffer::where('user_id', $request->id)->with('getProject')->get();
            }
            $data=[];

            foreach ($hireProjects as $project) {
                $data[] = array(
                    'id' => $project->getProject["id"],
                    'title' => "Hired for project " . $project->getProject["name"],
                    'start' => $project->getProject["date"],
                    'end' => $project->getProject["beforedate"],
                    'status' => $project["status"],
                    'url' => route('projects.details', [$project->getProject["id"]])
                );
            }
            return response()->json($data);
        }
    }
}
