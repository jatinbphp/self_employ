@extends('frontend.layouts.app')

@section('content')

    <div class="main-content-bx01 bg-colorbx">
        <div class="container">
            <div class="row">
                 <div class="col-xl-3">
                    <div class="filter-bx01">
                        <h3>Filter</h3>

                       <!-- <div class="custom-select" style="width:200px;"> -->
                            <select class="form-control" id="my_jobs_filter" name="filterBy"  aria-label="Filter By" >
                                @if ($filter && $filter == "all")
                                    <option value="all" selected>All</option>
                                @else
                                    <option value="all" >All</option>
                                @endif
                                @if ($filter == "progress")
                                    <option value="progress" selected>Open</option>
                                @else
                                    <option value="progress" >Open</option>
                                @endif
                                @if ($filter == "done")
                                    <option value="done" selected>Completed</option>
                                @else
                                    <option value="done">Completed</option>
                                @endif
                                
                            </select>
                        <!-- </div> -->
                    </div>
                </div> 

                <div class="col-xl-12">
                    <div class="job-post-mainbx1">
                        @if (count($jobs) > 0)
                            @foreach ($jobs as $job)
                                <div class="filter-result-bx01 filter-result-bx02">
                                    <div class="filter-resultsbx1 filter-resultsbx02">
                                        <div class="job-img">
                                            <img src="{{ $job->getJobPost->getJobPoster->profile_image }}" style="width: 100px;">
                                            <a href="{{ route('projects.details', $job->id) }}" class="close-btn1">Open</a>
                                            @if(auth()->check())
                                                @if(auth()->user()->id == $job->getJobPost->getJobPoster->id)
                                                <a href="{{ route('posts.edit', $job->id) }}" class="close-btn1">Edit</a>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="job-description">
                                            <div class="hours-bx1">
                                                <a href="{{ route('projects.details', $job->post_id) }}">
                                                    <h3>{{ $job->getJobPost->name }}</h3>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-shield" aria-hidden="true"></i>
                                                            {{ $job->getJobPost->getJobPoster->name }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                                            {{ $job->getJobPost->post_time }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                            {{ $job->getJobPost->location }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                                            {{ $job->getJobPost->created }}
                                                        </a>
                                                    </li>
                                                </ul>
                                                <p>{{ $job->getJobPost->description }}</p>
                                                <div class="job-bottomrowbx">
                                                    <div class="info-detail-menubx1">
                                                        @if (count($job->getJobPost->getPostSkills) > 3)
                                                            <ul class="->getJobPostcenter slider">
                                                                @foreach ($job->getJobPost->getPostSkills as $skill)
                                                                    <li>
                                                                        <a href="#">{{ $skill->getSKills->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            @foreach ($job->getJobPost->getPostSkills as $skill)
                                                                <span>
                                                                    {{ $skill->getSKills->name }}
                                                                </span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="price-btn01">
                                                        <a href="javacript:void(0)">$ {{ $job->getJobPost->amount }} <em> Per<br>
                                                                {{ $job->getJobPost->getBudgetTypes->name }}</em></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-rp-bx02">

                                            <img
                                                src="{{ count($job->getJobPost->getPostImages) > 0 ? $job->getJobPost->getPostImages[0]->post_images : env('APP_URL') . 'uploads/posts/post_images/post.jpg' }}">
                                            <!-- <img src="{{ asset('assets/images/defult-img.png') }}"> -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="filter-result-bx01 filter-result-bx02">
                                <div class="job-description">
                                    <div class="hours-bx1">

                                        <h3>No Records Found</h3>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="pagination-bx1">
                        {{ $jobs->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
