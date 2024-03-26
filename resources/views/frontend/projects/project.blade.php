@extends('frontend.layouts.app')

@section('content')
    <div class="main-content-bx01 login-page">
        <div class="container">
            <div class="row">
                <ul class="nav nav-tabs payment-nav01">
                    <li class="nav-item">
                        <a href="#project-details" class="nav-link active" data-bs-toggle="tab">Project Details</a>
                    </li>
                    <li class="nav-item">
                        <a href="#payment" class="nav-link" data-bs-toggle="tab">Payment</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="project-details">
                        <div class="row detail-rowbx">
                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 detail-colbx-left">
                                <div class="detail-titlebx1">
                                    <h2>{{ $project->name }}</h2>
                                </div>
                                <div class="detail-contentbx1">
                                    <h3>{{ $project->name }}</h3>
                                    <div class="post-minutbx">
                                        <em>Posted {{ $project->post_time }}</em>
                                        <i><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $project->address }}</i>
                                    </div>
                                </div>
                                <div class="detail-contentbx1">
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
                                <div class="detail-contentbx1">
                                    <h4>Project Type: <em> {{ $project->beforedate }}</em></h4>
                                </div>
                                <div class="detail-contentbx1">
                                    <h4>Skills & Expertise</h4>
                                    <div class="skills-bx1">
                                        <ul style="max-width: 100%;">
                                            @foreach ($project->getPostSkills as $skill)
                                                <li>{{ $skill->getSKills->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="detail-contentbx1">
                                    <h4>Images</h4>
                                    <div class="{{ asset('assets/images-bx1') }}">
                                        <ul style="display:flex; list-style: none;">
                                            @foreach ($project->getPostImages as $image)
                                                <li><img src="{{ $image->post_images }}" style="width: 100px;"></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="detail-contentbx1"
                                    style="border-bottom: 0; margin-bottom:0; padding-bottom: 0;">
                                    <h4>Offers</h4>
                                    <div class="transporter-bx1">
                                        <div class="left-img01"><img src="{{ asset('assets/images/round-img.png') }}"></div>
                                        <div class="right-contentbx1">
                                            <h6>Junior S.</h6>
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
                                                <ul>
                                                    <li><a href="#"><em></em> Chat</a></li>
                                                    <li><a href="#"><i></i> Award</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="transporter-contentbx">
                                        <p>Specialist Transporter. Click and collect specialist. Assembling and dismantling
                                            specialist.</p>
                                        <div class="viewbtn-row">
                                            <a href="#" class="more-btn">More
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                            </a>
                                            <a href="#" class="viewoffer-btn">View all Offers
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 detail-colbx-right">
                                <div class="by-postbx1">
                                    <div class="left-txtbx">
                                        <p>Posted by</p>
                                        <h4><a href="{{'/user/profile/'.$project->getJobPoster->id.'#client'}}">{{ $project->getJobPoster->name }}</a></h4>
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
                                <hr class="border-bottom">
                                <div class="task-bugetbx1">
                                    <h4>Task Budget</h4>
                                    <h2>$ {{ $project->amount }} <em style="font-size: 12px;">Per
                                            {{ $project->getBudgetTypes->name }}</em></h2>
                                    <a href="javascript:void(0)">Make an Offer</a>
                                </div>
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
                                        <h5>Australia</h5>
                                        <p>Buelach 2:08 pm</p>
                                    </div>
                                    <div class="paymet-verfiedbx1">
                                        <h5>15 jobs posted</h5>
                                        <p>14% hire rate, 3 open jobs</p>
                                    </div>
                                    <div class="paymet-verfiedbx1">
                                        <h5>$60 total spent</h5>
                                        <p>2 hires, 0 active</p>
                                    </div>
                                    <div class="paymet-verfiedbx1">
                                        <i>{{ $project->created }}</i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="payment">
                        <div class="row">
                            <div class="col-xl-9">
                                <div class="payment-bxleft1">
                                    <div class="payment-user-detailbx">
                                        <div class="user-img"><img src="{{ asset('assets/images/Ellipse02.png') }}">
                                        </div>
                                        <div class="user-detailbx1">
                                            <div class="user-flagbx">
                                                <!-- <img src="{{ asset('assets/images/Anguilla.png') }}"> -->
                                                <h4>{{ $project->getJobPoster->name }} <em>@
                                                        {{ $project->getJobPoster->first_name }}</em></h4>
                                            </div>
                                            <div class="completion-persant-rowbx">
                                                <ul>
                                                    <li><a href="javascript:void(0)"><em></em> Chat</a></li>
                                                </ul>
                                            </div>
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
                                                <i>$0.00 USD</i>
                                            </div>
                                            <div class="payment-info">
                                                <p>Released</p>
                                                <i>$0.00 USD</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="payment-samrybx">
                                        <div class="mileston-paymentbx">
                                            <h3>Milestones Payment</h3>
                                            <a href="#">Request Milestones</a>
                                        </div>
                                    </div>
                                    <div class="payment-samrybx" style="border-bottom: 0;">
                                        <h3>Created Milestones</h3>
                                        <div class="mileston-created">
                                            <div class="created-info">
                                                <p>Date</p>
                                                <hr>
                                                <i>21 Sep 2022</i>
                                            </div>
                                            <div class="created-info">
                                                <p>Description</p>
                                                <hr>
                                                <i>Project milestone </i>
                                            </div>
                                            <div class="created-info">
                                                <p>Status</p>
                                                <hr>
                                                <i>Active</i>
                                            </div>
                                            <div class="created-info">
                                                <p>Amount</p>
                                                <hr>
                                                <i>$12.00 USD</i>
                                            </div>
                                            <div class="created-info">
                                                <p></p>
                                                <hr>
                                                <a href="#">Request Release</a>
                                            </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
