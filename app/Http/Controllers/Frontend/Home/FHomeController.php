<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FHomeController extends Controller
{
    public function index()
    {
        return view('frontend.home.home');
    }

    public function search(Request $request)
    {
        $orderBy = isset($request->orderBy) ? $request->orderBy : 'DESC';
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = $request->radius * 1.60934;

        $categories = Category::all();
        $data = Post::selectRaw('count(category_id) as job_count, category_id')->groupBy('category_id')->get();
        $jobs_category_count = [];
        foreach ($data as $value) {
            $jobs_category_count[$value->category_id] = $value->job_count;
        }

        $jobs = Post::select('*')
            ->where('name', 'LIKE', '%' . $request->search . '%')
            ->where('status', 'active')
            ->with('getJobPoster', 'getPostImages', 'getBudgetTypes', 'getPostSkills')
            ->orderBy('created_at', $orderBy)
            ->paginate(6);

        return view('frontend.home.find-jobs', ['jobs' => $jobs, 'categories' => $categories, 'jobs_category_count' => $jobs_category_count]);

        if (isset($latitude) && !empty($latitude) && isset($longitude) && !empty($longitude) && isset($radius) && !empty($radius)) {
           
        } else {
            $jobs = Post::where('id', null)->get();
            return view('frontend.home.find-jobs', ['jobs' => $jobs, 'categories' => $categories, 'jobs_category_count' => $jobs_category_count]);
        }
    }
}
