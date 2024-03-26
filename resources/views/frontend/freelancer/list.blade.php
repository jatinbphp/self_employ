<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
    <div class="filter-bx01">
        <h3>Filter</h3>
        @foreach ($skills as $list)
            <div class="form-check">
                <input class="form-check-input skill-checkbox" type="checkbox" value="{{ $list->id }}" name="userSkill" data-id="{{$list->id}}"
                       id="flexCheckDefault_{{ $list->id }}" {{ $list->id == $selected_skill ? 'checked' : '' }}>
                <label class="form-check-label" for="flexCheckDefault_{{ $list->id }}">
                    <a style="color:white !important;text-decoration:none" href="{{ route('user.view.freelancer', ['userSkill' => $list->id]) }}">
                        {{ $list->name }}
                        ({{ count($list['allUserSkill']) }})
                    </a>
                </label>
            </div>
        @endforeach
    </div>
</div>

<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12" id="freelancerContent">
    <div class="job-post-mainbx1 pt-0">
        <div class="row">
            @if (count($users) > 0)
                @foreach ($users as $user)
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="cartbx01">
                            <div class="filter-result-bx02">
                                <div class="filter-resultsbx1">
                                    <div class="cart-userimg1">
                                        <img src="{{ $user->profile_image }}" style="width: 100px;">
                                    </div>
                                    <div class="job-description">
                                        <div class="hours-bx1">
                                            <a href="{{ route('user.view.profile', $user->id) }}">
                                                <h3>{{ $user->name }}</h3>
                                            </a>
                                            <div class="ratting-bx01">
                                                <div class="star-bx11">
                                                    <div class="small-ratings">
                                                        <i class="fa fa-star rating-color"></i>
                                                        <i class="fa fa-star rating-color"></i>
                                                        <i class="fa fa-star rating-color"></i>
                                                        <i class="fa fa-star rating-color"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <div class="emailbx1">
                                                    <a href="#">info@jhon.com</a>
                                                </div>
                                            </div>
                                            <div class="calendor-bx11">
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            {{ $user->created }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                            {{ $user->location }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <p>{{ $user->about }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-footerbx1">
                                <ul>
                                    <li><i><img src="https://labssol.com/dev/selfemployee/SelfEmployee/public/assets/images/file-icon11.png"></i> <b>100%</b> jobs Completed</li>
                                    <li><i><img src="https://labssol.com/dev/selfemployee/SelfEmployee/public/assets/images/budget-icon11.png"></i> <b>100%</b> On Budget</li>
                                    <li><i><img src="https://labssol.com/dev/selfemployee/SelfEmployee/public/assets/images/check-icon11.png"></i> <b>100%</b> On Time</li>
                                    <li><i><img src="https://labssol.com/dev/selfemployee/SelfEmployee/public/assets/images/hire-usericon11.png"></i> <b>N/A</b> Repeat hire Rate</li>
                                </ul>
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
