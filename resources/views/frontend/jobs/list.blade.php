<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
    <div class="filter-bx01">
        <h3>Filter</h3>
        @foreach ($skills as $list)
            <div class="form-check">
                <input class="form-check-input category-checkbox skill-checkbox" type="checkbox" value="{{ $list->id }}" name="jobSkills"
                       id="flexCheckDefault_{{ $list->id }}" {{ $list->id == $selected_skill ? 'checked' : '' }}>
                <label class="form-check-label" for="flexCheckDefault_{{ $list->id }}">
                    <a id="skillLink_{{$list->id}}" style="color:white !important;text-decoration:none" href="{{ route('jobs.index', array_merge(['skills_id' => $list->id], request()->except('skills_id'))) }}">
                        {{ $list->name }}
                        ({{ count($list['allPost']) }})
                    </a>
                </label>
            </div>
        @endforeach
    </div>
</div>

<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12" id="jobContent">
    <div class="job-post-mainbx1" id="postList">
        @if (count($jobs) > 0)
            @foreach ($jobs as $job)
                <div class="filter-result-bx01 filter-result-bx02 category-{{$job->category_id}}">
                    <div class="filter-resultsbx1 filter-resultsbx02">
                        <div class="job-img">
                            <img src="{{ $job->getJobPoster->profile_image }}" style="width: 100px;">
                            <a href="{{ route('projects.details', $job->id) }}" class="close-btn1">Open</a>
                        </div>
                        <!--<div class="job-rp-bx02">
                                                <img src="{{ count($job->getPostImages) > 0 ? $job->getPostImages[0]->post_images : env('APP_URL') . 'uploads/posts/post_images/post.jpg' }}">
                                            </div>-->
                        <div class="job-description">
                            <div class="hours-bx1">
                                <ul>
                                    <li>
                                        <a href="{{url('user/profile/'.$job->getJobPoster->id.'#client')}}">
                                            <i class="fa fa-shield" aria-hidden="true"></i>
                                            {{ $job->getJobPoster->name }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                            {{ $job->post_time }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            {{ $job->location }}
                                        </a>
                                    </li>
                                    <li class="date-li-bx01">
                                        <a href="#">
                                            <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                            {{ $job->created }}
                                        </a>
                                    </li>
                                </ul>
                                <a href="{{ route('projects.details', $job->id) }}">
                                    <h3>{{ $job->name }}</h3>
                                </a>

                                @if(!empty($job->getPostCategory))
                                    <p class="mb-1">
                                        {{$job->getPostCategory->name}}
                                    </p>
                                @endif

                                @if(!empty($job->getPostSkills) && count($job->getPostSkills) > 0)
                                    <ul>
                                        @foreach($job->getPostSkills as $skill)
                                            <li class="p-1 m-sm-1 bg-primary text-white">{{$skill['getSKills']['name']}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <!--<p>{{ $job->description }}</p>
                                                    <div class="job-bottomrowbx">
                                                        <div class="price-btn01">
                                                            <a href="javacript:void(0)">$ {{ $job->amount }} <em> Per<br>
                                                                    {{ $job->getBudgetTypes->name }}</em></a>
                                                        </div>
                                                    </div>-->
                            </div>
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
        <div class="row">
            <div class="col-xl-12">
                <div class="pagination-bx1">
                    {{ $jobs->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
