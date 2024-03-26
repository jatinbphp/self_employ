<div class="filter-result-bx01 filter-result-bx02 category-{{$job->category_id}}">
    <div class="filter-resultsbx1 filter-resultsbx02">
        <div class="job-img">
            <img src="{{ $job->getJobPoster->profile_image }}" style="width: 100px;">
            <a href="{{ route('projects.details', $job->id) }}" class="close-btn1">Open</a>
        </div>
        <div class="job-rp-bx02">
            <img
                src="{{ count($job->getPostImages) > 0 ? $job->getPostImages[0]->post_images : env('APP_URL') . 'uploads/posts/post_images/post.jpg' }}">
            <!-- <img src="{{ asset('assets/images/defult-img.png') }}"> -->
        </div>
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
                    <p>
                        <b>Category: </b> {{$job->getPostCategory->name}}
                    </p>
                @endif

                @if(!empty($job->getPostSubCategory))
                    <p>
                        <b>Sub Category: </b> {{$job->getPostSubCategory->name}}
                    </p>
                @endif

                @if(!empty($job->getPostSkills) && count($job->getPostSkills) > 0)
                    <p>
                        <b>Skills: </b>
                        @foreach($job->getPostSkills as $skill)
                            <span class="p-2 bg-primary text-white">{{$skill['getSKills']['name']}}</span>
                        @endforeach
                    </p>
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
