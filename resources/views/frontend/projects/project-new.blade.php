@extends('frontend.layouts.app')

@section('content')
    <div class="main-content-bx01 login-page">
        <div class="container">
            {{-- @if (!is_null($project->getAcceptedOffers) &&
                auth()->check() &&
                $project->getAcceptedOffers->user_id == auth()->user()->id &&
                $project->getAcceptedOffers->status == 'active')
                <div class="row">
                    <div class="post-taskbx01">
                        <div class="form-spacebx1">
                            <h5>
                                {{ $project->name }} Project posted by {{ $project->getJobPoster->name }} Wants to hire
                                {{ $project->getAcceptedOffers->getUser->name }}
                            </h5>
                            <p>Please press button on to confirm:
                                <button type="button" class="btn btn-primary btn-user-accept"
                                    data-post_id="{{ $project->id }}"
                                    data-offerAcceptedUser="{{ $project->getAcceptedOffers->user_id }}"
                                    data-post_user_id="{{ $project->user_id }}">
                                    Accept offer
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            @endif --}}
            @if($state == 0)
            <div class="row" style="width: 100%; height:100%; display:flex; justify-content:center; align-items:center;">
                <h4 style="text-align: center; color:white;">No Project</h4>
            </div>
            @endif
            @if($state == 1)
                <div class="row mt-5">
                    <input type="hidden" id="tab_priority" value="0">
                    <ul class="nav nav-tabs payment-nav01">
                        <li class="nav-item">
                            <a href="#project-details" class="nav-link active" id="project_tab" data-bs-toggle="tab">Project Details</a>
                        </li>
                        <li class="nav-item">
                            <a href="#proposals" class="nav-link"  id="payment_tab" data-bs-toggle="tab">Proposals</a>
                        </li>
                        <li class="nav-item {{ (auth()->check() && auth()->user()->id == $project->getJobPoster->id) || (!is_null($project->getAcceptedOffers) && auth()->check() && auth()->user()->id == $project->getAcceptedOffers->user_id) ? '' : 'd-none' }}">
                            <a href="#payment" class="nav-link"  id="payment_tab" data-bs-toggle="tab">Payment</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="project-details">
                            <div class="row detail-rowbx">
                                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 detail-colbx-left">
                                    <!--<div class="detail-titlebx1">-->
                                    <!--    <h2>{{ $project->name }}</h2>-->
                                    <!--</div>-->
                                    <div class="detail-contentbx1" style="border: none; padding: 0;">
                                        <div class="slider project-slide-section01 center" id="slider_height" style="visibility: hidden;" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "autoplay": false}'>
                                             @if (count($project->getPostImages) > 0)
                                                @foreach ($project->getPostImages as $image)
                                                    <div class="project-slide01" >
                                                        <img src="{{ $image->post_images }}" >
                                                    </div>

                                                @endforeach
                                            @else
                                                <div class="project-slide01">
                                                    <img src="{{ env('APP_URL') . 'uploads/posts/post_images/post.jpg' }}">
                                                </div>
                                            @endif

                                        </div>
                                                                            <!--<div class="images-bx1">-->
                                        <!--    <ul style="display:flex; list-style: none;">-->
                                        <!--        @if (count($project->getPostImages) > 0)-->
                                        <!--            @foreach ($project->getPostImages as $image)-->
                                        <!--                <li><img src="{{ $image->post_images }}" style="width: 100px;"></li>-->
                                        <!--            @endforeach-->
                                        <!--        @else-->
                                        <!--            <li>-->
                                        <!--                <img src="{{ env('APP_URL') . 'uploads/posts/post_images/post.jpg' }}"-->
                                        <!--                    style="width: 400px;">-->
                                        <!--            </li>-->
                                        <!--        @endif-->
                                        <!--    </ul>-->
                                        <!--</div>-->
                                    </div>
                                    <div class="detail-contentbx1">
                                        <h3>{{ $project->name }}</h3>
                                        <div class="post-minutbx">
                                            <em><i class="fa fa-clock-o" aria-hidden="true"></i> Posted {{ $project->post_time }}</em>
                                            <i><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $project->address }}</i>
                                        </div>
                                    </div>
                                    <div class="detail-contentbx1">
                                        <h3>Description</h3>
                                        <h5>{{ $project->description }}</h5>
                                    </div>
                                    <!-- <div class="detail-contentbx1">
                                            <div class="project-lengthbx1">
                                                <ul>
                                                    <li>
                                                        <div class="project-length-row1">
                                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                            <h4> Less than 30 hrs/week</h4>
                                                        </div>
                                                        <p>Hourly</p>
                                                    </li>
                                                    <li>
                                                        <div class="project-length-row1">
                                                            <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                                            <h4>1 to 3 months</h4>
                                                        </div>
                                                        <p>Project length</p>
                                                    </li>
                                                    <li>
                                                        <div class="project-length-row1">
                                                            <i class="fa fa-shield" aria-hidden="true"></i>
                                                            <h4>Intermediate</h4>
                                                        </div>
                                                        <p>I am looking for a mix </p>
                                                        <p>of experience and value</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div> -->
                                    <!--<div class="detail-contentbx1">-->
                                    <!--    <h4>Project Type: <em> ongoing Project</em></h4>-->
                                    <!--</div>-->
                                    <div class="detail-contentbx1">
                                        <h4>Skills & Expertise</h4>
                                        <div class="skills-bx1">
                                            <ul style="max-width: 100%;">
                                                @foreach ($project->getPostSkills as $skill)
                                                    <li>{{ $skill->getSkills->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <!--<div class="detail-contentbx1">-->
                                    <!--    <h4>Images</h4>-->
                                    <!--    <div class="images-bx1">-->
                                    <!--        <ul style="display:flex; list-style: none;">-->
                                    <!--            @if (count($project->getPostImages) > 0)-->
                                    <!--                @foreach ($project->getPostImages as $image)-->
                                    <!--                    <li><img src="{{ $image->post_images }}" style="width: 100px;"></li>-->
                                    <!--                @endforeach-->
                                    <!--            @else-->
                                    <!--                <li>-->
                                    <!--                    <img src="{{ env('APP_URL') . 'uploads/posts/post_images/post.jpg' }}"-->
                                    <!--                        style="width: 100px;">-->
                                    <!--                </li>-->
                                    <!--            @endif-->
                                    <!--        </ul>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="detail-contentbx1" style="border-bottom: 0; margin-bottom:0; padding-bottom: 0;">
                                        <h4>Offers</h4>
                                        @if (count($project->getOffers) > 0)
                                            @foreach ($project->getOffers as $offer)
                                                <div class="detail-contentbx1 mb-4 {{ $loop->iteration > 1 ? 'd-none hidden-content' : '' }}"
                                                    style="border-bottom: 0; margin-bottom:0; padding-bottom: 0;">
                                                    <div class="transporter-bx1">
                                                        <div class="left-img01">
                                                            <a href="{{ route('user.view.profile', [$offer->user_id]) }}">
                                                                <img src="{{ $offer->getOfferUser->profile_image }}"
                                                                    style="width:60px">
                                                            </a>
                                                        </div>
                                                        <div class="right-contentbx1">
                                                            <a style="text-decoration: none;color:#575757" href="{{ route('user.view.profile', [$offer->user_id]) }}">
                                                                <h6 >
                                                                    {{ $offer->getOfferUser->name }}
                                                                </h6>
                                                            </a>
                                                            <span
                                                                class="{{ auth()->check() && auth()->user()->id == $project->getJobPoster->id ? '' : 'd-none' }}">$
                                                                {{ $offer->amount }}</span>
                                                            <div class="ratings">
                                                                <div class="ratings-bxleft">
                                                                    <i class="fa fa-star rating-color"></i>
                                                                    <i class="fa fa-star rating-color"></i>
                                                                    <i class="fa fa-star rating-color"></i>
                                                                    <i class="fa fa-star rating-color"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <div class="reviews-bx">
                                                                    <p>4.5 <i>253 Reviews</i></p>
                                                                </div>
                                                            </div>
                                                            <div class="completion-persant-rowbx">
                                                                <p><b>94%</b> Completion rate</p>
                                                                <ul
                                                                    class="{{ auth()->check() && auth()->user()->id == $project->getJobPoster->id ? '' : 'd-none' }}">
                                                                    <li>
                                                                        {{-- <a type="button" class="start_chat"
                                                                            data-touserid="{{ auth()->check() ? $offer->getOfferUser->id : '' }}"
                                                                            data-tousername="{{ $offer->getOfferUser->name }}">
                                                                            <em></em> Chat
                                                                        </a> --}}
                                                                        <a  type="button"
                                                                            class="chat-toggle"
                                                                            data-isposter="1"
                                                                            data-pstatus="{{$project->status}}"
                                                                            data-id="{{ auth()->check() ? $offer->getOfferUser->id : '' }}"
                                                                            data-user="{{ auth()->check() ? $offer->getOfferUser->name : '' }}"
                                                                            data-project_id="{{ auth()->check() ? $project->id : '' }}"
                                                                            data-project_name="{{ auth()->check() ? $project->name : '' }}">
                                                                            <em></em> Chat
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a id="award_btn" class="accept_offer alert alert-success"
                                                                            href="javascript:void(0)"
                                                                            data-touserid="{{ auth()->check() ? $offer->getOfferUser->id : '' }}"
                                                                            data-pid="{{ $project->id }}"
                                                                            style="{{ !is_null($project->getAcceptedOffers) && $project->getAcceptedOffers->user_id == $offer->getOfferUser->id ? 'pointer-events: none; cursor: default;' : '' }}"
                                                                            >
                                                                            <i></i>
                                                                            <span>{{ !is_null($project->getAcceptedOffers) && $project->getAcceptedOffers->user_id == $offer->getOfferUser->id ? ($project->status == "awarded"?"Award Pending":(count($milestones) == 0 ? "Milestone Pending":"Ongoing Project")) : 'Award' }}</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="transporter-contentbx">
                                                        <p>{{ $offer->description }}</p>
                                                    </div>
                                                    <hr>
                                                </div>
                                            @endforeach
                                            @if (count($project->getOffers) > 1)
                                                <div class="transporter-contentbx">
                                                    <div class="viewbtn-row">
                                                        <a href="javascript:void(0)" class="more-btn"></a>
                                                        <a href="javascript:void(0)" class="viewoffer-btn">
                                                            View all Offers
                                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div>
                                                <h5>No offer made yet</h5>
                                            </div>
                                        @endif
                                    </div>-->
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 detail-colbx-right">
                                    <div class="by-postbx1">
                                        <div class="left-txtbx">
                                            <p>Posted by</p>
                                            <h4><a class="job-poster" href="{{url('user/profile/'.$project->getJobPoster->id.'#client')}}">{{ $project->getJobPoster->name }}</a></h4>
                                        </div>
                                        <div class="right-imgbx">
                                            <img src="{{ $project->getJobPoster->profile_image }}" style="width:100px">
                                        </div>
                                    </div>
                                    <div class="due-datebx1">
                                        <h4>Due date<br>
                                            {{ !is_null($project->due_date) ? $project->due_date : "I'm Flexiable" }}</h4>
                                        <p>Anytime</p>
                                    </div>

                                    @if (auth()->check())
                                        @if ($project->user_id != auth()->user()->id)
                                            <hr class="border-bottom">
                                            <div class="task-bugetbx1">
                                                <h4>Task Budget</h4>
                                                <h2>$ {{ $project->amount }}
                                                    <em style="font-size: 12px;">Per {{ $project->getBudgetTypes->name }}</em>
                                                </h2>
                                                @if($project->status == "active" && !$offer_made)
                                                    <a href="javascript:void(0)" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#{{ !auth()->user() ? 'LoginModaldrop' : 'staticBackdrop' }}">
                                                        Make an Offer
                                                    </a>
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                    <hr class="border-bottom">
                                    <div class="about-clientbx1">
                                        <h3>About the client</h3>
                                        <p><i class="fa fa-credit-card" aria-hidden="true"></i> Payment Verified</p>
                                        <div class="ratings">
                                            <div class="ratings-bxleft">
                                                <i class="fa fa-star rating-color"></i>
                                                <i class="fa fa-star rating-color"></i>
                                                <i class="fa fa-star rating-color"></i>
                                                <i class="fa fa-star rating-color"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="reviews-bx">
                                                <p>4.5 <i>253 Reviews</i></p>
                                            </div>
                                        </div>
                                        <div class="paymet-verfiedbx1">
                                            <?php
                                            $location = explode(',', $project->address);
                                            $loc_length = count($location);

                                            ?>
                                            <h5>{{ $location[$loc_length - 1] }}</h5>
                                            <p>{{ $loc_length > 4 ? $location[$loc_length - 3] : '' }} {{ $project->created }}
                                            </p>
                                        </div>
                                        <div class="paymet-verfiedbx1">
                                            <h5>{{ count($projects) }} jobs posted</h5>
                                            <p>14% hire rate, {{ count($projects) }} open jobs</p>
                                        </div>
                                        <div class="paymet-verfiedbx1">
                                            <h5>$60 total spent</h5>
                                            <p>2 hires, 0 active</p>
                                        </div>
                                        <div class="paymet-verfiedbx1">
                                            <i>Member since {{ $project->member }}</i>
                                        </div>
                                        @if(auth()->check() && auth()->user()->id == $project->user_id && $project->status == "active")
                                        <div style="width: 100%; display:flex; justify-content:center; align-items:center; margin-top:20px;">
                                            <button class="btn btn-danger" id="delete_project_btn" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" >Delete Project</button>
                                        </div>
                                        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
                                        aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Confirmation</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                You really want to delete the project({{$project->name}})?
                                                </div>
                                                <input type="hidden" id="delete_pid" value="{{$project->id}}">
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-success" id="confirm_delete_btn" >Confirm</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="proposals">
                            <div class="row detail-rowbx">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 detail-colbx-left">
                                    <div class="detail-contentbx1" style="border-bottom: 0; margin-bottom:0; padding-bottom: 0;">
                                        @if (count($project->getOffers) > 0)
                                            @foreach ($project->getOffers as $offer)
                                                <div class="detail-contentbx1 mb-4 {{ $loop->iteration > 1 ? 'd-none hidden-content' : '' }}"
                                                     style="border-bottom: 0; margin-bottom:0; padding-bottom: 0;">
                                                    <div class="transporter-bx1">
                                                        <div class="left-img01">
                                                            <a href="{{ route('user.view.profile', [$offer->user_id]) }}">
                                                                <img src="{{ $offer->getOfferUser->profile_image }}"
                                                                     style="width:60px">
                                                            </a>
                                                        </div>
                                                        <div class="right-contentbx1">
                                                            <a style="text-decoration: none;color:#575757" href="{{ route('user.view.profile', [$offer->user_id]) }}">
                                                                <h6 >
                                                                    {{ $offer->getOfferUser->name }}
                                                                </h6>
                                                            </a>
                                                            <span
                                                                class="{{ auth()->check() && auth()->user()->id == $project->getJobPoster->id ? '' : 'd-none' }}">$
                                                                {{ $offer->amount }}</span>
                                                            <div class="ratings">
                                                                <div class="ratings-bxleft">
                                                                    <i class="fa fa-star rating-color"></i>
                                                                    <i class="fa fa-star rating-color"></i>
                                                                    <i class="fa fa-star rating-color"></i>
                                                                    <i class="fa fa-star rating-color"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <div class="reviews-bx">
                                                                    <p>4.5 <i>253 Reviews</i></p>
                                                                </div>
                                                            </div>
                                                            <div class="completion-persant-rowbx">
                                                                <p><b>94%</b> Completion rate</p>
                                                                <ul
                                                                    class="{{ auth()->check() && auth()->user()->id == $project->getJobPoster->id ? '' : 'd-none' }}">
                                                                    <li>
                                                                        {{-- <a type="button" class="start_chat"
                                                                            data-touserid="{{ auth()->check() ? $offer->getOfferUser->id : '' }}"
                                                                            data-tousername="{{ $offer->getOfferUser->name }}">
                                                                            <em></em> Chat
                                                                        </a> --}}
                                                                        <a  type="button"
                                                                            class="chat-toggle"
                                                                            data-isposter="1"
                                                                            data-pstatus="{{$project->status}}"
                                                                            data-id="{{ auth()->check() ? $offer->getOfferUser->id : '' }}"
                                                                            data-user="{{ auth()->check() ? $offer->getOfferUser->name : '' }}"
                                                                            data-project_id="{{ auth()->check() ? $project->id : '' }}"
                                                                            data-project_name="{{ auth()->check() ? $project->name : '' }}">
                                                                            <em></em> Chat
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a id="award_btn" class="accept_offer alert alert-success"
                                                                           href="javascript:void(0)"
                                                                           data-touserid="{{ auth()->check() ? $offer->getOfferUser->id : '' }}"
                                                                           data-pid="{{ $project->id }}"
                                                                           style="{{ !is_null($project->getAcceptedOffers) && $project->getAcceptedOffers->user_id == $offer->getOfferUser->id ? 'pointer-events: none; cursor: default;' : '' }}"
                                                                        >
                                                                            <i></i>
                                                                            <span>{{ !is_null($project->getAcceptedOffers) && $project->getAcceptedOffers->user_id == $offer->getOfferUser->id ? ($project->status == "awarded"?"Award Pending":(count($milestones) == 0 ? "Milestone Pending":"Ongoing Project")) : 'Award' }}</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="transporter-contentbx">
                                                        <p>{{ $offer->description }}</p>
                                                    </div>
                                                    <hr>
                                                </div>
                                            @endforeach
                                            @if (count($project->getOffers) > 1)
                                                <div class="transporter-contentbx">
                                                    <div class="viewbtn-row">
                                                        <a href="javascript:void(0)" class="more-btn"></a>
                                                        <a href="javascript:void(0)" class="viewoffer-btn">
                                                            View all Offers
                                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div>
                                                <h5>No offer made yet</h5>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="payment">
                            <div class="row">
                                <div class="col-xl-9">
                                    <div class="payment-bxleft1">
                                        <div class="payment-user-detailbx">
                                            <div class="user-img"><img src="{{ $project->getJobPoster->profile_image }}"
                                                    style="width:100px"></div>
                                            <div class="user-detailbx1">
                                                <div class="user-flagbx">
                                                    <!-- <img src="" style="width: 100px;"> -->
                                                    <h4>{{ $project->getJobPoster->name }} <em>@
                                                            {{ $project->getJobPoster->first_name }}</em></h4>
                                                </div>
                                                @if($project->getAcceptedOffers)
                                                <div class="completion-persant-rowbx">
                                                    <ul>
                                                        <li>
                                                            <a
                                                                type="button"
                                                                class="chat-toggle"
                                                                data-isposter="{{auth()->user()->id == $project->getJobPoster->id?1:0}}"
                                                                data-pstatus="{{$project->status}}"
                                                                data-id="{{ (auth()->user()->id == $project->getJobPoster->id) ? $project->getAcceptedOffers->user_id : $project->getJobPoster->id }}"
                                                                data-user="{{ (auth()->user()->id == $project->getJobPoster->id) ? $project->getAcceptedOffers->name : $project->getJobPoster->name }}"
                                                                data-project_id="{{ auth()->check() ? $project->id : '' }}"
                                                                data-project_name="{{ auth()->check() ? $project->name : '' }}"
                                                                href="javascript:void(0);"
                                                            >
                                                                <em></em> Chat
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="payment-samrybx">
                                            <h3>Payment Summary</h3>
                                            <div class="payment-samryrow">
                                                <div class="payment-info">
                                                    <p>Requested</p>
                                                    <i>$0.00 USD</i>
                                                </div>
                                                <div class="payment-info">
                                                    <p>In Progress</p>
                                                    <i id="in_progress_amount">${{$inprogress}} USD</i>
                                                </div>
                                                <div class="payment-info">
                                                    <p>Released</p>
                                                    <i id="released_amount">${{$released}} USD</i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="payment-samrybx">
                                            <div class="mileston-paymentbx">
                                                <h3>Milestones Payment</h3>
                                                @if(auth()->check() && auth()->user()->id == $project->user_id && $project->status == "progress")
                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#createMilestoneModal">Create Milestone</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="payment-samrybx" style="border-bottom: 0;">
                                            <h3>Created Milestones</h3>
                                            <div class="mileston-created">
                                                <div class="created-info">
                                                    <p>Date</p>
                                                </div>
                                                <div class="created-info">
                                                    <p>Description</p>
                                                </div>
                                                <div class="created-info">
                                                    <p>Status</p>
                                                </div>
                                                <div class="created-info">
                                                    <p>Amount</p>
                                                </div>
                                                <div class="created-info" style="text-align: center">
                                                    <p>Action</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div id="created_milestones_wrapper" class="mileston-created" style="flex-direction: column;">
                                                @foreach($milestones as $milestone)
                                                    <div class="milestone-item">
                                                        <div class="created-info">
                                                            <p>{{$milestone->created}}</p>
                                                        </div>
                                                        <div class="created-info">
                                                            <p>{{$milestone->description}}</p>
                                                        </div>
                                                        <div class="created-info">
                                                            @if($milestone->status=="active")
                                                                <p style="font-size: 16px;">In Progress</p>
                                                            @elseif($milestone->status=="done")
                                                                <p style="font-size: 16px; color:green;">Released</p>
                                                            @endif
                                                        </div>
                                                        <div class="created-info">
                                                            <p>{{$milestone->amount}}</p>
                                                        </div>
                                                        @if($milestone->status == "active")
                                                        <div class="created-info">
                                                            <div class="dropdown dropdownbtn01">
                                                                <button type="button" class="btn btn-primary dropdown-toggle"
                                                                    data-bs-toggle="dropdown">
                                                                    Management
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        @if((!is_null($project->getAcceptedOffers) && auth()->check() && auth()->user()->id == $project->getAcceptedOffers->user_id))
                                                                            <a type="button" href="javascript:void(0)" class="dropdown-item">
                                                                                View Invoice
                                                                            </a>
                                                                        @elseif((auth()->check() && auth()->user()->id == $project->getJobPoster->id))
                                                                            <a class="dropdown-item" href="javascript:void(0)" id="release_btn" data-mid="{{$milestone->id}}"
                                                                                 data-amount="{{$milestone->amount}}" data-description="{{$milestone->description}}" data-pid="{{$milestone->project_id}}"
                                                                                  onclick="releaseMilestone(this)" data-bs-toggle="modal" data-bs-target="#releaseConfirmModal">
                                                                                Release Milestone
                                                                            </a>
                                                                        @endif
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                                            Cancel Milestone
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if($milestone->status == "done")
                                                        <div class="created-info">
                                                            <div class="" style="text-align: center">
                                                                <button type="button" class="btn btn-info">
                                                                    View Invoice
                                                                </button>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="payment-bxright1">
                                        <div class="what-milestonebx1">
                                            <h4>What are milestones payments?</h4>
                                        </div>
                                        <div class="milestone-txtbx">
                                            <p>The Milestone Payment system is the recommended mode of paying freelancers on the
                                                site. It offers protection to both clients and freelancers by giving equal
                                                control over created payments for awarded projects and accepted quotes</p>
                                            <ul>
                                                <li>
                                                    <img src="{{ asset('assets/images/flag-outline.png') }}">
                                                    <i>Created</i>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/images/shield-outline.png') }}">
                                                    <i>Secured</i>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/images/circle-outline_.png') }}">
                                                    <i>Released</i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="safe-scurebx">
                                            <h6>Milestones are:</h6>
                                            <p>
                                                <span>Safe & Secure.</span> We securely hold your client’s deposited money.<br>
                                                <span>Controlled by you.</span> Only you can canceled a created milestone.<br>
                                                <span>Release on completion.</span> Once you finish a task you can request the
                                                release of the Milestone.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Model Body -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog dispute-popupbx">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Request a Dispute</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="dispute-popup-contentbx1">
                                                    <div class="refund-requestbx">
                                                        <h3>Refund Requested</h3>
                                                        <form>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault" id="flexRadioDefault1">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    Total invoice amount ( $0.00)
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    Other amount
                                                                </label>
                                                            </div>
                                                            <div class="number-input">
                                                                <input type="number" class="form-control"
                                                                    placeholder="$0.00">
                                                            </div>
                                                            <div class="dispute-formbx1">
                                                                <h3>Message</h3>
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write Message here..."></textarea>
                                                                <div class="dispute-form-submit-btn">
                                                                    <div class="file-uploadbx">
                                                                        <label for="first-img2"><em>Attach a file</em> <i>Up to
                                                                                25 MB</i></label>
                                                                        <input type="file" name="" id="first-img2"
                                                                            style="display: none;visibility: none;">
                                                                    </div>
                                                                </div>
                                                                <div class="dispute-form-submit-btn form022">
                                                                    <button class="btn btn-success mb-3">Send Request</button>
                                                                    <a href="javascript:void(0)" type="button"
                                                                        class="btn-close btn btn-secondary" data-bs-dismiss="modal"
                                                                        aria-label="Close">Cancel</a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="already-refund-bx1">
                                                        <h3>Already Requested a Refund?</h3>
                                                        <div class="text-bx01">
                                                            <p>If you are not able to reach an agreement with your freelancer
                                                                about an hourly contact, you can file a dispute</p>
                                                        </div>
                                                        <div class="text-bx01">
                                                            <p>Disputes must be filed during the week's review period.</p>
                                                        </div>
                                                        <div class="text-bx01">
                                                            <p>Learn about the dispute process or <em>complete the dispute
                                                                    form</em></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Model Body -->
                                <div class="modal fade" id="releaseConfirmModal" tabindex="-1" aria-labelledby="releaseConfirmModalLabel"
                                aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                          <h4 class="modal-title">Confirmation</h4>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                          You really want to release the milestone?
                                        </div>
                                        <input type="hidden" id="release_mid" value="">
                                        <input type="hidden" id="release_amount" value="">
                                        <input type="hidden" id="release_description" value="">
                                        <input type="hidden" id="release_project_id" value="">
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-success" id="confirm_release_btn" >Confirm</button>
                                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>

                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@if($state == 1)
@include('frontend.modals.modal-login')
@include('frontend.modals.modal-make-offer')
<div id="user_model_details"></div>
@endif
@endsection
@if($state == 1)
@section('script')
<script>
    $( window ).on( "load", function() {
        $('#slider_height').css("visibility", 'visible');
        $('.project-slide01').height($('#slider_height').height()).css({display:'flex', alignItems:'center'});
        var tab_num = get("tab");
        if(tab_num == 1) {
            $("#project_tab").removeClass("active");
            $("#payment_tab").addClass("active");
            $("#project-details").removeClass("active");
            $("#project-details").removeClass("show");
            $("#payment").addClass("active");
            $("#payment").addClass("show");
        } else {
            $("#project_tab").addClass("active");
            $("#payment_tab").removeClass("active");
            $("#project-details").addClass("active");
            $("#project-details").addClass("show");
            $("#payment").removeClass("active");
            $("#payment").removeClass("show");
        }

    });


    $(document).ready(function() {
        $(document).on("click", "#confirm_release_btn", function() {
            $(this).attr('disabled', '');
            var mid = $("#release_mid").val();
            var amount = $("#release_amount").val();
            var description = $("#release_description").val();
            var project_id = $("#release_project_id").val();
            $.ajax({
                url: base_url + "/projects/releasemilestone",
                data: {
                    mid: mid,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "POST",
                dataType: "json",
                success: function(response) {
                    $("#releaseConfirmModal").modal("hide");
                    $("#confirm_release_btn").removeAttr('disabled');
                    if(response.state == 1) {
                        successToast("Successfully Released!");
                        send("{{$project->getAcceptedOffers?$project->getAcceptedOffers->user_id:1}}", "Milestone released!<br>Description: "+description+"<br>Amount: $"+amount+" USD", project_id, null, 4);
                        var milestones = response.milestones;
                        var requested = 0;
                        var inprogress = 0;
                        var released = 0;
                        var milestones_wrapper = $("#created_milestones_wrapper");
                        milestones_wrapper.empty();
                        for(var i=0; i<milestones.length; i++) {
                            if(milestones[i]["status"] == "active")
                                inprogress += milestones[i]["amount"];
                            else if(milestones[i]["status"] == "done") {
                                released += milestones[i]["amount"];
                            }

                            var milestone_item = $("<div>").attr("class", "milestone-item mileston-created");
                            var date_div = $("<div>").attr("class", "created-info");
                                $("<p>").text(milestones[i]["created"]).appendTo(date_div);
                                date_div.appendTo(milestone_item);
                            var desc_div = $("<div>").attr("class", "created-info");
                                $("<p>").text(milestones[i]["description"]).appendTo(desc_div);
                                desc_div.appendTo(milestone_item);
                            var status_div = $("<div>").attr("class", "created-info");
                                if(milestones[i]["status"] == "active")
                                    $("<p>").css("font-size", "16px").text("In Progress").appendTo(status_div);
                                else if(milestones[i]["status"] == "done")
                                    $("<p>").css({"font-size":"16px", "color":"green"}).text("Released").appendTo(status_div);
                                status_div.appendTo(milestone_item);
                            var amount_div = $("<div>").attr("class", "created-info");
                                $("<p>").text(milestones[i]["amount"]).appendTo(amount_div);
                                amount_div.appendTo(milestone_item);
                            var dropdown_wrapper = $("<div>").attr("class", "created-info");
                            if(milestones[i]["status"] == "active") {
                                var dropdown_div = $("<div>").attr("class", "dropdown dropdownbtn01");
                                var release_btn = $("<button>").attr({"class":"btn btn-primary dropdown-toggle",
                                    'data-bs-toggle':"dropdown"}).text("Management");
                                    release_btn.appendTo(dropdown_div)
                                var ul = $("<ul>").attr("class", "dropdown-menu");
                                var li1 = $("<li>");
                                    $("<a>").attr({"class":"dropdown-item", "href":"javascript:void(0)", "id":"release_btn",
                                        "data-mid":milestones[i]["id"], "data-amount":milestones[i]["amount"], "data-description":milestones[i]["description"],
                                        "data-pid":milestones[i]["project_id"],
                                          "onclick":"releaseMilestone(this)", "data-bs-toggle":"modal", "data-bs-target":"#releaseConfirmModal"}).text("Release Milestone").appendTo(li1);
                                    li1.appendTo(ul);
                                var li2 = $("<li>");
                                    $("<a>").attr({"class":"dropdown-item", "href":"javascript:void(0)"}).text("Cancel Milestone").appendTo(li2);
                                    li2.appendTo(ul);
                                    ul.appendTo(dropdown_div);
                                    dropdown_div.appendTo(dropdown_wrapper);
                                    dropdown_wrapper.appendTo(milestone_item);
                            } else if(milestones[i]["status"] == "done") {
                                var invoice_wrapper = $("<div>").css("text-align", "center").attr("class", "created-info");
                                    $("<button>").attr("class", "btn btn-info").text("View Invoice").appendTo(invoice_wrapper);
                                invoice_wrapper.appendTo(milestone_item);
                            }
                            milestone_item.appendTo(milestones_wrapper);
                        }
                    }
                }
            });
        });

        $(document).on("click", "#confirm_delete_btn", function() {
            var pid = $("#delete_pid").val();
            $("#confirm_delete_btn").attr('disabled', '');
            $.ajax({
                url: base_url + "/projects/deleteproject",
                data: {
                    pid: pid,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "POST",
                dataType: "json",
                success: function(response) {
                    $("#deleteConfirmModal").modal("hide");
                    if(response.state == 1) {
                        successToast("Successfully Deleted!");
                        setTimeout((function() {
                            $("#confirm_delete_btn").removeAttr('disabled');
                            location.href = "/myprojects";
                        }), 500);
                    }
                }
            });
        });
    });

    function releaseMilestone(obj) {
        var mid = $(obj).attr("data-mid");
        var amount = $(obj).attr("data-amount");
        var description = $(obj).attr("data-description");
        var pid = $(obj).attr("data-pid");
        $("#release_mid").val(mid);
        $("#release_amount").val(amount);
        $("#release_description").val(description);
        $("#release_project_id").val(pid);
    }



    function get(name){
    if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
        return decodeURIComponent(name[1]);
    }

    function preventModalHide() {
        const createMilestoneModal = new bootstrap.Modal(document.getElementById('createMilestoneModal'));
        const alertCloseButtons = document.querySelectorAll('.alert button[data-bs-dismiss="alert"]');

        alertCloseButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            event.stopPropagation();
        });
        });

        createMilestoneModal._element.addEventListener('hide.bs.modal', (event) => {
        if (event.target.classList.contains('alert')) {
            event.preventDefault();
        }
        });
    }
</script>
@endsection
@endif
