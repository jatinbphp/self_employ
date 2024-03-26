@extends('frontend.layouts.app')

@section('content')

    <div class="main-content-bx01 bg-colorbx">
        <div class="container">
            <div class="row">
                <div class="profile-title d-flex justify-content-between">
                    <h1 style="color:#fff;">Profile</h1>
                    <div class="d-flex justify-content-center">
                        <div class="switch-profile">
                            <p class=" m-0 switch-profile-text">View Client Profile</p>
                        </div>
                        <!-- <div class="team-profile ms-1">
                            <p class="m-0 team-profile-text">View Team Profile</p>
                        </div> -->
                    </div>

                </div>
            </div>
            <div class="row ">
                <div class="profile-viewbx1">
                    <!-- <div class="profile-header1"><img id="cover_image" data-image-url="{{ $user->cover_image }}" src="{{ $user->cover_image }}" />
                        @if (auth()->check() && $user->id == auth()->user()->id)
                         <form class="profile-header-form" method="post" action="{{route('profile.profile_settings.cover_update')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="set-profle-images-bx1">
                                <div class="set-image1">
                                    <div class="cover-submit-cancel">
                                        <button id="cover_edit" class="btn btn-primary" name="update" value="update"><i class="fa fa-edit"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inputrow2" style="display: none;">
                                            <div class="image-uploadfile profile-setting-bx01">
                                                <label for="first-img1"><i><img src="https://labssol.com/dev/selfemployee/SelfEmployee/public/assets/images/upload-ow.png"> </i></label>
                                                <input  type="file" name="cover" id="cover_input" style="display: none;visibility: none;">
                                                <img id="profile-preview" src="#" alt="your image" class="d-none" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cover-submit-btnbx" style="display: none;">
                                <div class="submit-btnbx0">
                                    <button type="submit" class="btn btn-primary" name="update" value="update"><i class="fa fa-save"></i></button>
                                </div>
                                <div class="submit-cancel">
                                    <button id="cover-submit_cancel" class="btn btn-primary" name="update" value="update"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div> -->


                    <div class="row prfile-imgrow">
                        <div class="col-12" id="team_visit_container">
                            <div>
                                @if ($team != null && count($team_member) == 0)
                                <a href="{{'/team/profile/'.$team->id}}" class="visit_team_btn">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <img src="{{$team->profile_image}}" style="width:30px; height: 30px;" />
                                        <p class=" ms-2 mb-0">Visit Team</p>
                                    </div>
                                </a>
                                @elseif(count($team_member)>0 && auth()->check() && $user->id == auth()->user()->id)
                                    <a href="{{'/team/profile/'.$team_member[0]->team_id}}" class="visit_team_btn">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <p class=" ms-2 mb-0">Leave Team</p>
                                        </div>
                                    </a>
                                @elseif(count($team_member)>0 && auth()->check() && $user->id != auth()->user()->id)
                                    <a href="{{'/team/profile/'.$team_member[0]->team_id}}" class="visit_team_btn">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <p class=" ms-2 mb-0">{{$user->first_name." ".$user->last_name." is a member of a team as ".$team_member[0]->role." :Visit Here"}}</p>
                                        </div>
                                    </a>
                                @elseif( auth()->check() && $user->id == auth()->user()->id)
                                    <div class="d-flex justify-content-end">
                                        <a data-bs-toggle="modal" id="create_team_modal" class="create_team_btn" data-bs-target="#{{ !auth()->user() ? 'LoginModaldrop' : 'createTeam' }}">create a team</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 ">
                            <div class="profile-image-container">
                                <div class="profile-img">
                                    <img id="profile_image" data-image-url="{{ $user->profile_image }}" src="{{ $user->profile_image }}">
                                </div>
                                @if (auth()->check() && $user->id == auth()->user()->id)
                                <form class="profile-image-form" method="post" action="{{route('profile.profile_settings.image_update')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="set-profle-images-bx1">
                                        <div class="set-image1">
                                            <div class="profile-submit-cancel">
                                                <button id="image_edit" class="btn btn-primary" name="update" value="update"><i class="fa fa-edit"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-inputrow2" style="display: none;">
                                                    <div class="image-uploadfile profile-setting-bx01">
                                                        <label for="first-img1"><i><img src="https://labssol.com/dev/selfemployee/SelfEmployee/public/assets/images/upload-ow.png"> </i></label>
                                                        <input  type="file" name="image" id="image_input" style="display: none;visibility: none;">
                                                        <img id="profile-preview" src="#" alt="your image" class="d-none" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-submit-btnbx" style="display: none;">
                                        <div class="submit-btnbx0">
                                            <button type="submit" class="btn btn-primary" name="update" value="update"><i class="fa fa-save"></i></button>
                                        </div>
                                        <div class="submit-cancel">
                                            <button id="image_submit_cancel" class="btn btn-primary" name="update" value="update"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>

                        <div class="col-xl-5 col-lg-5 alignverticle-colbx1">
                            <div class="profile-detailbx">
                                <div class="profile-name-container">
                                    <h4>{{ $user->name }} </h4>
                                    <div class="profile-status offline" id="profile-online-{{$user->id}}">

                                    </div>
                                </div>
                                <p>
                                    Last online {{ $user->last_login }}<br>
                                    {{ $user->user_address }}<br>
                                    Member since {{ $user->created }}
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5">
                            <div class="profile-menubx1">
                                <ul>
                                    <li class="envalop-icon"><a href="#">Email Verified</a></li>
                                    <li class="phone-icon"><a href="#">Phone Verified</a></li>
                                    <li class="user-icon"><a href="#">Identity Verified</a></li>
                                    <li class="payment-icon"><a href="#">Payment Verified</a></li>
                                     <!-- <li class="payment-icon"><a href="{{ route('portfolio.index', $user->id) }}">Portfolio</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row profile-review-bx1 prfile-exprow" id="freelancer-profile" >
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="reviews-alignbx1 d-block">
                                <h4>Reviews</h4>
                                <div class="reviews-txtbx1">
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
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <p class="pe-2 fw-bold text-review-values">{{count($projects)}}</p>
                                            <p>Jobs Completed</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <p class="pe-2 fw-bold text-review-values">N/A</p>
                                            <p>On Budget</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <p class="pe-2 fw-bold text-review-values">N/A</p>
                                            <p>On Time</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <p class="pe-2 fw-bold text-review-values">N/A</p>
                                            <p>Repeat Hire Rate</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row profile-review-bx1 prfile-exprow" id="client-profile">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="reviews-alignbx1 d-block">
                                <h4>Reviews</h4>
                                <div class="reviews-txtbx1">
                                    <div class="ratings">
                                        <div class="ratings-bxleft">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="reviews-bx">
                                            <p>0 <i>0 Reviews</i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <p class="pe-2 fw-bold text-review-values">{{count($posts)}}</p>
                                            <p>Open Project</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <p class="pe-2 fw-bold text-review-values">{{count($posts)}}</p>
                                            <p>Active Project</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <p class="pe-2 fw-bold text-review-values">{{count($posts)}}</p>
                                            <p>Past Project</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <p class="pe-2 fw-bold text-review-values">{{count($posts)}}</p>
                                            <p>Total Project</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row prfile-exprow">
                        <div class="col-xl-7 col-lg-7">
                            <div class="profile-content-bx1">
                                <div class="d-flex justify-content-between">
                                    <h3 class="exp01 about-icon1">About:</h3>
                                    <div class="profile-submit-cancel">
                                        <button id="about_edit" class="btn btn-primary" name="update" value="update"><i class="fa fa-edit"></i></button>
                                    </div>
                                    <div class="about-submit-btnbx" style="display: none;">
                                        <div class="submit-btnbx0">
                                            <button id="about-submit-temp" class="btn btn-primary" name="update" value="update"><i class="fa fa-save"></i></button>
                                        </div>
                                        <div class="submit-cancel">
                                            <button id="about-submit_cancel" class="btn btn-primary" name="update" value="update"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>

                                @if (auth()->check() && $user->id == auth()->user()->id)
                                     <form class="profile-about-form " style="display:none" method="post" action="{{route('profile.profile_settings.about_update')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group profile-text-areabx01 ow-textarea">
                                            <textarea name="about" class="form-control form-control-lg" placeholder="About yourself">{{auth()->user()->about}}</textarea>
                                        </div>
                                        <button type="submit" id="about_submit" class="btn btn-primary d-none" name="update" value="update"><i class="fa fa-save"></i></button>
                                    </form>
                                @endif
                                <p id="profile-about-content">{{ $user->about }}</p>
                            </div>

                            <div class="profile-content-bx1 freelancer-profile-experience">
                                <div class="d-flex justify-content-between">
                                    <h3 class="exp01">Experience:</h3>
                                    <div class="profile-submit-cancel">
                                        <button id="skill_edit" class="btn btn-primary" name="update" value="update"><i class="fa fa-edit"></i></button>
                                    </div>
                                    <div class="skill-submit-btnbx" style="display: none;">
                                        <div class="submit-btnbx0">
                                            <button id="skill-submit-temp" class="btn btn-primary" name="update" value="update"><i class="fa fa-save"></i></button>
                                        </div>
                                        <div class="submit-cancel">
                                            <button id="skill-submit_cancel" class="btn btn-primary" name="update" value="update"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @if (auth()->check() && $user->id == auth()->user()->id)
                                     <form class="profile-skill-form " style="display:none" method="post" action="{{route('profile.profile_settings.skill_update')}}" enctype="multipart/form-data">
                                        @csrf
                                        <!--<p class="mb-0 mt-2">Category</p>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <select class="form-select {{$errors->has('category') ? 'is-invalid' : ''}}" name="category" id="category">
                                                    <option value="">Please Select Category</option>
                                                    @foreach($categories as $category)
{{--                                                    <option value="{{$category->id}}" {{auth()->user()->category_id == $category->id ? 'selected':''}}>{{$category->name}}</option>--}}
                                                    <option value="{{$category->id}}" {{$parentCategoryId == $category->id ? 'selected':''}}>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                         <p class="mb-0 mt-2">Sub Category</p>
                                         <div class="form-group">
                                             <div class="form-group">
                                                 <select class="form-select {{ $errors->has('sub_category') ? 'is-invalid' : '' }}" name="sub_category" id="sub_category">
                                                     @if(count($subCategory) > 0)
                                                         @foreach($subCategory as $list)
                                                             <option value="{{$list['id']}}" @if(count($userSkills) > 0 && $userSkills[0]['category_id'] == $list['id']) selected @endif>{{$list['name']}}</option>
                                                         @endforeach
                                                      @endif
                                                 </select>
                                                 @error('sub_category')
                                                 <div class="invalid-feedback">
                                                     {{ $message }}
                                                 </div>
                                                 @enderror
                                             </div>
                                         </div>-->

                                        <p class="mb-0 mt-2">Select Skills</p>
                                        <div class="form-group">
                                            <div class="form-group">
                                            <select class="form-select select2 {{$errors->has('skills') ? 'is-invalid' : ''}}" name="skills[]" id="skillList" multiple
                                                    style="height:100px !important">
                                                @foreach($allSkills as $skill)
                                                    @php
                                                        $selected = '';
                                                        foreach ($userSkills as $uSkill){
                                                            if($skill['id'] == $uSkill['skill_id']){
                                                                $selected = 'selected';
                                                                continue;
                                                            }
                                                        }
                                                    @endphp
                                                    <option value="{{$skill['id']}}" {{$selected}}>{{$skill['name']}}</option>
                                                @endforeach
                                            </select>
                                            @error('skills')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            </div>
                                        </div>
                                        <button type="submit" id="skill_submit" class="btn btn-primary d-none" name="update" value="update"><i class="fa fa-save"></i></button>
                                    </form>
                                @endif
                                <ul id="profile-skill-content">
                                    @if (count($userSkills) > 0)
                                        @foreach ($userSkills as $skills)
                                            <li>
                                                <a href="#">{{ $skills->getSkills->name }}</a>
                                            </li>
                                        @endforeach
                                    @else
                                        No Skills Added
                                    @endif
                                    {{-- <a href="#" class="seemore-btn">See more</a> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5" >
                            <div id='wrap' class="mt-2 mb-4 calendar-wrapbx1 freelancer-profile-calender" >
                                <h3>Check {{ $user->name }} Availability</h3>
                                <div id='calendar'></div>
                                <div style='clear:both'></div>
                            </div>
                        </div>
                    </div>
                    <div class="row prfile-portfolio freelancer-profile-portfolio" style="margin-top: 0;" >
                        <div class="">
                            <div class="portfolio-bx01">
                                <div class="btn-bx01">
                                    @if (auth()->check() && auth()->user()->id == $user->id)
                                        <ul style="justify-content: end;">
                                            <li class="orang-btnbx text-white">
                                                <a data-bs-toggle="modal" data-bs-target="#{{ !auth()->user() ? 'LoginModaldrop' : 'addPortfolio' }}"
                                                    ><em>+</em> Add Portfolio</a>
                                            </li>
                                        </ul>
                                     @endif
                                </div>
                                <div class="row">
                                    @foreach ($portfolios as $portfolio)
                                        @if ($portfolio->status == "approve")
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 portfolio-column01">
                                                <div class="portfolio-colbx01">
                                                    <h3>{{$portfolio->name}}</h3>
                                                    <div class="position-relative">
                                                        <div class="portfolio-img01">
                                                            @if (count($portfolio->getPortfolioImages) > 0)
                                                                <img src="{{ $portfolio->getPortfolioImages[0]->portfolio_images}}">
                                                            @else
                                                                <img src="{{ asset('assets/images/default-image.png') }}">
                                                            @endif
                                                        </div>
                                                        <div class="portfolio-hover-content">
                                                            <div class="text-center">
                                                                <div class="portfolio-count">
                                                                    {{count($portfolio->getPortfolioImages)}}
                                                                </div>
                                                                <a
                                                                    class="btn-read-more"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#readPortfolio"
                                                                    data-name="{{$portfolio->name}}"
                                                                    data-description="{{$portfolio->description}}"
                                                                    data-image="{{$portfolio->getPortfolioImages}}"
                                                                    data-user="{{$user->id}}"
                                                                    data-client="{{$portfolio->getProjectId->getJobPost->user_id}}"
                                                                    data-post-link="{{getenv('APP_URL').'projects/'.$portfolio->getProjectId->getJobPost->id}}"
                                                                    data-skill="{{$portfolio->getProjectId->getJobPost->getPostSkills}}"
                                                                    data-status="{{$portfolio->status}}"
                                                                    data-id="{{$portfolio->id}}"
                                                                >
                                                                    Read more
                                                                </a>
                                                            </div>

                                                        </div>
                                                    </div>

                                                <!-- <div class="review-starbx">
                                                    <h4>Employer Review</h4>
                                                    <div class="ratings">
                                                        <i class="fa fa-star rating-color"></i>
                                                        <i class="fa fa-star rating-color"></i>
                                                        <i class="fa fa-star rating-color"></i>
                                                        <i class="fa fa-star rating-color"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div> -->
                                                    <div class="portfolio-contentbx01">
                                                        <p>{{$portfolio->description}}</p>
                                                        <!-- <a href="#">read more</a> -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="row">
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach ($portfolios as $portfolio)
                                        @if ($portfolio->status == "pending")
                                            @if (auth()->check())
                                                @if(!empty($portfolio->getProjectId))
                                                    @if(!empty($portfolio->getProjectId->getJobPost))
                                                        @if ($portfolio->getProjectId->getJobPost->user_id == auth()->user()->id || auth()->user()->id == $user->id)
                                                            @if ($i == 0)
                                                                <h4 class="text-section-portfolio">Pending</h4>
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endif
                                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 portfolio-column01">
                                                                <div class="portfolio-colbx01">
                                                                    <h3 class="text-header-portfolio">{{$portfolio->name}}</h3>
                                                                    <div class="position-relative">
                                                                        <div class="portfolio-img01">
                                                                            @if (count($portfolio->getPortfolioImages) > 0)
                                                                                <img src="{{ $portfolio->getPortfolioImages[0]->portfolio_images}}">
                                                                            @else
                                                                                <img src="{{ asset('assets/images/default-image.png') }}">
                                                                            @endif
                                                                        </div>
                                                                        <div class="portfolio-hover-content">
                                                                            <div class="text-center">
                                                                                <div class="portfolio-count">
                                                                                    {{count($portfolio->getPortfolioImages)}}
                                                                                </div>
                                                                                <a
                                                                                    class="btn-read-more"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#readPortfolio"
                                                                                    data-name="{{$portfolio->name}}"
                                                                                    data-description="{{$portfolio->description}}"
                                                                                    data-image="{{$portfolio->getPortfolioImages}}"
                                                                                    data-user="{{$user->id}}"
                                                                                    data-client="{{$portfolio->getProjectId->getJobPost->user_id}}"
                                                                                    data-post-link="{{getenv('APP_URL').'projects/'.$portfolio->getProjectId->getJobPost->id}}"
                                                                                    data-skill="{{$portfolio->getProjectId->getJobPost->getPostSkills}}"
                                                                                    data-status="{{$portfolio->status}}"
                                                                                    data-id="{{$portfolio->id}}"
                                                                                >
                                                                                    Read more
                                                                                </a>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="portfolio-contentbx01">
                                                                        <p>{{$portfolio->description}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            <!-- <ul>
                                <li>
                                    <a href="#">
                                        <h5>Project Name</h5>
                                        <div class="project-img1"><img src="{{ asset('assets/images/project-img1.png') }}">
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h5>Project Name</h5>
                                        <div class="project-img1"><img src="{{ asset('assets/images/project-img1.png') }}">
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h5>Project Name</h5>
                                        <div class="project-img1"><img src="{{ asset('assets/images/project-img1.png') }}">
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h5>Project Name</h5>
                                        <div class="project-img1"><img src="{{ asset('assets/images/project-img1.png') }}">
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <a href="#" class="load-morebtn">Load more</a>
                            <div class="seeallrevewsbx">
                                <a href="#">See all revews <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.modals.modal-login')
    @include('frontend.modals.modal-hire')
    @include('frontend.modals.modal-add-portfolio')
    @include('frontend.modals.modal-read-portfolio')
    @include('frontend.modals.modal-create-team')

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            console.log(window.location.hash)
            if (window.location.hash == '#client') {
                $('.switch-profile').trigger('click');
            }
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            /* initialize the external events
            -----------------------------------------------------------------*/
            $('#external-events div.external-event').each(function() {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);
                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });
            });

            /* initialize the calendar
            -----------------------------------------------------------------*/
            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'title',
                    //center: 'agendaDay,agendaWeek,month',
                    right: 'prev,next' // today'
                },
                editable: true,
                firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
                selectable: true,
                defaultView: 'month',
                axisFormat: 'h:mm',
                columnFormat: {
                    month: 'ddd', // Mon
                    week: 'ddd d', // Mon 7
                    day: 'dddd M/d', // Monday 9/7
                    agendaDay: 'dddd d'
                },
                titleFormat: {
                    month: 'MMMM yyyy', // September 2009
                    week: "MMMM yyyy", // September 2009
                    day: 'MMMM yyyy' // Tuesday, Sep 8, 2009
                },
                allDaySlot: false,
                selectHelper: true,
                select: function(start, end) {
                    var check = $.fullCalendar.formatDate(start, 'yyyy-MM-dd');
                    var today = $.fullCalendar.formatDate(new Date(), 'yyyy-MM-dd');
                    if (check >= today) {
                        if ("{{ auth()->check() }}" == true) {
                            $('.hire_me').modal('show');
                            $('.hire_me').find('#title').val(
                                "{{ auth()->check() ? 'Project By ' . auth()->user()->username : '' }}"
                            );
                            $('.hire_me').find('#starts-at').val(convertFullDateYear(start));
                            $('.hire_me').find('#description').val(
                                "Hi {{ auth()->check() ? auth()->user()->username : '' }}, I noticed your profile and would like to offer you my project. We can discuss any details over chat."
                            );
                            $('.hire_me').find('#ends-at').val(convertFullDateYear(end));
                        } else {
                            $('.login-modal').modal('show');
                        }
                    }
                },
                eventClick: function(event, element) {
                    // Display the modal and set the values to the event values.
                    $('.hire_me').modal('show');
                    $('.hire_me').find('#title').val(event.title);
                    $('.hire_me').find('#starts-at').val(event.start);
                    $('.hire_me').find('#ends-at').val(event.end);
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                droppable: false, // this allows things to be dropped onto the calendar !!!
                drop: function(date, allDay) { // this function is called when something is dropped
                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');
                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);
                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                },
                events: "{{ route('profile.getProjects', ['id' => request()->id]) }}",
            });

            // Bind the dates to datetimepicker.
            // You should pass the options you need
            //$("#starts-at, #ends-at").datetimepicker();
            // Whenever the user clicks on the "save" button om the dialog

            $(".hire_me form").validate({
                rules: {
                    title: {
                        required: true
                    },
                    date: {
                        required: true
                    },
                    beforedate: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    budget: {
                        required: true
                    },
                    amount: {
                        required: true
                    },
                },
                messages: {
                    title: {
                        required: "Please enter Check Title",
                    },
                    starts_at: {
                        request: "Please enter Start Date"
                    },
                    ends_at: {
                        request: "Please enter End Date"
                    },
                    description: {
                        request: "Please enter Description"
                    },
                    budget: {
                        request: "Please enter Budget Type"
                    },
                    amount: {
                        request: "Please enter amount"
                    },
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "{{ route('projects.hire') }}",
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.success == true) {
                                successToast(response.message);
                                $('.hire_me').modal('toggle');
                                setTimeout((function() {
                                    window.location
                                        .reload();
                                }), 500);

                                $('#save-event').on('click', function() {
                                    var title = $('#title').val();
                                    if (title) {
                                        var eventData = {
                                            title: title,
                                            start: $('#starts-at').val(),
                                            end: $('#ends-at').val()
                                        };
                                        $('#calendar').fullCalendar('renderEvent',
                                            eventData, true); // stick? = true
                                    }
                                    $('#calendar').fullCalendar('unselect');
                                    $('.modal').find('input').val('');
                                    $('.modal').modal('hide');
                                });
                            } else {
                                errorToast(response.message);
                            }
                        }
                    });
                }
            });
        });

        function convertFullDateYear(str) {
            var date = new Date(str),
                mnth = ("0" + (date.getMonth() + 1)).slice(-2),
                day = ("0" + date.getDate()).slice(-2);
            hours = ("0" + date.getHours()).slice(-2);
            minutes = ("0" + date.getMinutes()).slice(-2);
            return [date.getFullYear(), mnth, day].join("-");
            return [date.getFullYear(), mnth, day, hours, minutes].join("-");
        }

        const dt_new = new DataTransfer();
        $('input[type="file"][name="images[]"]').on('change', function() {
            console.log("file changeing");
            var previewImagesZone = $('.preview-images-zone');

            // Clear preview zone
            previewImagesZone.empty();
            for (let file of this.files) {
                dt_new.items.add(file);
            }
            // Mise à jour des fichiers de l'input file après ajout
            this.files = dt_new.files;
            var files = $(this).get(0).files;

            // Loop through selected files and display them
            for (let i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img_container = $('<div class="select-img-box py-3 px-3">');
                    var img = $('<img class="img-fluid" width="150px" height="150px">').attr('src', e.target.result);
                    var hover_container = $('<div class="hover-delete-container">').attr('data-file-id', i);
                    hover_container.html('<i class="fa fa-times select-img-icon"></i>')
                    img.appendTo(img_container);
                    hover_container.appendTo(img_container);
                    img_container.appendTo(previewImagesZone);
                }
                reader.readAsDataURL(file);
            }

            $(document).unbind().on('click', '.hover-delete-container',  function(e) {
                e.preventDefault();
                e.stopPropagation();
                var delete_id = $(this).data('file-id')
                var input = $('.select-file-image')
                var files = input.get(0).files;
                console.log(dt_new.files);

                for (let i = 0; i < files.length; i++) {
                    console.log("sdfsdfsdfsd");
                    if (delete_id == i) {
                        console.log("deleted_id", delete_id);
                        dt_new.items.remove(i);
                        delete_id = null;
                    }
                }
                input.get(0).files = dt_new.files
                reRenderPreview();
            });

            $(document).unbind().on('click', '#btn_close',  function(e) {
                e.preventDefault();
                e.stopPropagation();
                dt_new.clearData();
                var previewImagesZone = $('.preview-images-zone');
                previewImagesZone.empty();
            });

            function reRenderPreview() {
                var previewImagesZone = $('.preview-images-zone');
                previewImagesZone.empty();
                var files = $('.select-file-image').get(0).files;

                for (let i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var img_container = $('<div class="select-img-box py-3 px-3">');
                        var img = $('<img class="img-fluid" width="150px" height="150px">').attr('src', e.target.result);
                        var hover_container = $('<div class="hover-delete-container">').attr('data-file-id', i);
                        hover_container.html('<i class="fa fa-times select-img-icon"></i>')
                        img.appendTo(img_container);
                        hover_container.appendTo(img_container);
                        img_container.appendTo(previewImagesZone);
                    }
                    reader.readAsDataURL(file);
                }
            }
        });

        $('.btn-read-more').on('click', function() {
            $("#slider_container").empty();
            var slide_element = $('<div id="slider_portfolio"></div>')
            $("#slider_container").append(slide_element);
            var name = $(this).data('name');
            var description = $(this).data('description');
            var images = $(this).data('image');
            var client_id = $(this).data('client');
            console.log(client_id);

            var portfolio_id = $(this).data('id');
            var status = $(this).data('status');
            var skill = $(this).data('skill');
            var postLink = $(this).data('post-link');
            console.log(postLink);

            $("#read-portfolio-skill-container").empty();
            $('#portfolio_name_link').attr('href', postLink);

            skill.forEach((item)=>{
                var skillSpan = $('<span class="read-portfolio-skill-span"></span>')
                skillSpan.text(item.get_s_kills.name);
                console.log(item.get_s_kills.name);
                console.log(skillSpan);
                $("#read-portfolio-skill-container").append(skillSpan);
            })

            $('#portfolio_name').text(name);
            $('#portfolio_description').text(description);

            for (var i = 0; i < images.length; i++) {
                var html_str = '<div class="project-slide0' + '" ><img src="' + images[i].portfolio_images + '" style="margin:auto; width:100%"></div>';
                slide_element.append($(html_str));
            }

            $("#slider_portfolio").slick({
                fade: true,
                cssEase: 'linear',
                dots: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode:true,
                arrow: true,
                autoplay: false,
                autoplaySpeed: 2000,
                prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' style='font-size:40px; color:black' aria-hidden='true'></i></button>",
                nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' style='font-size:40px; color:black' aria-hidden='true'></i></button>",
                responsive: [
                    {
                        breakpoint:576,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });

            $('.slick-track').css('width', '100%');
            $('.slick-slide').css('width', '490px');
            if (JSON.parse("\"{{ json_encode(auth()->user()) }}\"") != "null"){
                var user_id = JSON.parse("{{ json_encode(auth()->check() ? auth()->user()->id : null) }}");
            } else {
                var user_id = null
            }
            console.log(user_id);

            if (client_id == user_id && status =="pending") {
                $('#portfolio_action_form').css('display', 'flex')
                $('#portfolio_approve').val(portfolio_id);
                $('#portfolio_reject').val(portfolio_id);
            } else {
                $('#portfolio_action_form').css('display', 'none')
            }
        });

        let profile=true;

        $('.switch-profile').on('click', function() {
            if (profile) {
                $('#client-profile').css('display', 'flex');
                $('#freelancer-profile').css('display', 'none');
                $('.freelancer-profile-calender').css('visibility', 'hidden');
                $('.freelancer-profile-experience').css('display', 'none');
                $('.freelancer-profile-portfolio').css('display', 'none');
                $('#team_visit_container').css('display', 'none');
                $('.switch-profile-text')[0].innerHTML='View Freelancer Profile';
                profile=!profile;
            } else {
                $('#client-profile').css('display', 'none');
                $('#freelancer-profile').css('display', 'flex');
                $('.freelancer-profile-calender').css('visibility', 'visible');
                $('.freelancer-profile-experience').css('display', 'block');
                $('.freelancer-profile-portfolio').css('display', 'flex');
                $('#team_visit_container').css('display', 'block');
                $('.switch-profile-text').text('View Client Profile');
                profile=!profile;
            }
        })

        $(document).on('click', '#about_edit', function(e) {
            e.preventDefault();
            $('.about-submit-btnbx').css('display', 'flex');
            $('#about_edit').css('display', 'none');
            $('#profile-about-content').css('display', 'none');
            $('.profile-about-form').css('display', 'block');
        });

        $(document).on('click', '#about-submit_cancel', function(e) {
            e.preventDefault();
            $('#about_edit').css('display', 'block');
            $('.about-submit-btnbx').css('display', 'none');
            $('#profile-about-content').css('display', 'block');
            $('.profile-about-form').css('display', 'none');
        });

        $(document).on('click', '#about-submit-temp', function(e) {
            e.preventDefault();
            $('#about_submit').trigger('click');
        });

        $(document).on('click', '#skill_edit', function(e) {
            e.preventDefault();
            $('.skill-submit-btnbx').css('display', 'flex');
            $('#skill_edit').css('display', 'none');
            $('#profile-skill-content').css('display', 'none');
            $('.profile-skill-form').css('display', 'block');
        });

        $(document).on('click', '#skill-submit_cancel', function(e) {
            e.preventDefault();
            $('#skill_edit').css('display', 'block');
            $('.skill-submit-btnbx').css('display', 'none');
            $('#profile-skill-content').css('display', 'block');
            $('.profile-skill-form').css('display', 'none');
        });

        $(document).on('click', '#skill-submit-temp', function(e) {
            e.preventDefault();
            $('#skill_submit').trigger('click');
        });

        $('#category').on('change', function(){
            var categoryId = $(this).val();
            $.ajax({
                url: '{{url('getSubCategory')}}',
                method: 'POST',
                data: { categoryId: categoryId },
                success: function(response) {
                    if(response.result == 1){
                        $("#sub_category").empty();
                        $("#sub_category").append('<option value="">Please Select Sub Category</option>');
                        $("#sub_category").append(response.option);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        })

        $('#sub_category').on('change', function(){
            var categoryId = $(this).val();
            $.ajax({
                url: '{{url('getSkills')}}',
                method: 'POST',
                data: { category_id: categoryId },
                success: function(response) {
                    $("#skillList").empty();
                    $("#skillList").attr('data-placeholder','Please select skills');
                    $("#skillList").append(response.option);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        })
    </script>
@endsection
