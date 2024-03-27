@php
        $category = \App\Models\Category::with('subCategory','subCategory.getSkills')->where('parent_id',0)->where('status','active')->select('id','name')->get();
@endphp
<header class="header-bx02">
    <div class="header-bx01">
        <div class="container">
            <div class="row header-row01">
                <div class="col-xl-2 col-lg-3 col-md-5 col-sm-8 logo-colbx1">
                    <div class="logo">
                        <a href="{{ route('home.index') }}">
                            <img src="{{ asset('assets/images/logo2.png') }}">
                        </a>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-7 col-sm-4 navigation-col-bx01">
                    <div class="nav-alignbx01">
                        <div class="navigation-bx01 navigation-bx02">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <div class="container-fluid">
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->route()->uri == 'find/jobs' ? 'active' : '' }}"
                                                    aria-current="page" href="{{ route('jobs.index') }}">Jobs</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->route()->uri == 'freelancer' ? 'active' : '' }}"
                                                    href="{{ route('user.view.freelancer') }}">Freelancer</a>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" role="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                    href="{{ route('page.categories') }}">
                                                    Categories
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    @if(count($category) > 0)
                                                        @foreach($category as $list)
                                                            <li><a class="dropdown-item" href="#">{{$list['name']}}</a></li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <div class="icon-ulbx1 desktop-displaybx1">
                                <ul>
                                    @auth
                                    <li>
                                        <a id="count_reset">
                                            @if($unread_notification_count > 0)<em id="notification_count">{{$unread_notification_count}}</em>@endif
                                            <i class="fa fa-bell-o" aria-hidden="true"></i>
                                        </a>
                                        <ul class="user-dropdown01">
                                        	<li class="notification-bx01">
                                        		<h4>Notification</h4>
                                        		<a href="#">See More</a>
                                        	</li>
                                            <div class="notification-list">
                                                @forelse ($notifications as $notification)
                                                    @if ($notification->type != 2)
                                                        <li class="user-notifictionli1" id="notification_container"
                                                            data-url="{{route('projects.details',['id'=>$notification->type == '1'?$notification->post_id:$notification->post_id])}}">
{{--                                                            data-url="{{url('projects/'.$notification->type == '1'?$notification->post_id:$notification->post_id.'?tab=1')}}">--}}
                                                            <a >
                                                                <div class="notification-image-container"><img class="notification-image" src="{{count($notification->post->getPostImages) > 0 ? $notification->post->getPostImages[0]->post_images : 'uploads/posts/post_images/post.jpg' }}"></div>
                                                                <div class="notification-contentbx">
                                                                    <p>{{$notification->content}}</p>
                                                                    <p class="post_date" style="text-align:right;" data-post-date="{{$notification->date_time_str}}">{{ $notification->date_human_readable }}</p>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li class="user-notifictionli1">
                                                            <a href="/team/profile/{{$notification->from_team_id}}">
                                                                <div class="notification-image-container"><img class="notification-image" src="{{$notification->fromTeamId->profile_image}}"></div>
                                                                <div class="notification-contentbx">
                                                                    <!-- <div class="title-row">
                                                                        <p>{{$notification->content}}</p>
                                                                        <p class="post_date" data-post-date="{{$notification->date_time_str}}">{{ $notification->date_human_readable }}</p>
                                                                    </div> -->
                                                                    <p>{{$notification->content}}</p>
                                                                    <!-- <p>{{$notification->content}}</p> -->
                                                                    <p class="post_date" style="text-align:right;" data-post-date="{{$notification->date_time_str}}">{{ $notification->date_human_readable }}</p>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @endif
                                                @empty
                                                @endforelse
                                            </div>
                                        </ul>
                                    </li>
                                    <li><a href="#">
                                            @if($unread > 0)<em id="total_unread_badge">{{ $unread }}</em>@endif
                                            <i class="fa fa-comment-o" aria-hidden="true"></i>
                                        </a>
                                        <ul class="user-dropdown01">
                                        	<li class="notificationbx01">
                                        		<h4>Messages</h4>
                                        		<a href="{{ route('chat.users-fullscreen') }}">See More</a>
                                        	</li>
                                            @forelse ($messages as $message)
                                            {{-- @if($post->last_message) --}}
                                            <script>console.log("{{$message->unread}}")</script>
                                            <li class="user-notifictionli1">
                                                <a href="javascript:void(0);" class="chat-toggle"
                                                data-isposter="{{$message->is_poster}}"
                                                data-pstatus="{{$message->post_status}}"
                                                @if($message->from_user == auth()->user()->id)
                                                    data-id="{{ $message->toUser->id }}"
                                                    data-user="{{ $message->toUser->name }}"
                                                @else
                                                    data-id="{{ $message->fromUser->id }}"
                                                    data-user="{{ $message->fromUser->name }}"
                                                @endif
                                                data-project_id="{{ $message->post_id }}"
                                                data-project_name="{{ $message->post->name }}">
                                                    <div class="userimg1"><img src="{{ $message->fromUser->profile_image }}" width="35px"></div>
                                                    <div class="user-contentbx">
                                                        <div class="title-row">
                                                            @if($message->from_user == auth()->user()->id)
                                                                <h3>{{ $message->toUser->name }}</h3>
                                                                <p>{{ $message->date_human_readable }}</p>
                                                            @else
                                                                <h3>{{ $message->fromUser->name }}</h3>
                                                                <p>{{ $message->date_human_readable }}</p>
                                                            @endif
                                                        </div>
                                                        @if($message->from_user == auth()->user()->id)
                                                            <p>{{ "You: ".Illuminate\Support\Str::limit($message->content, 20) }}</p>
                                                        @else
                                                            <p>{{ Illuminate\Support\Str::limit($message->content, 20) }}</p>
                                                        @endif
                                                        @if($message->unread > 0)
                                                        <div class="unread-message-badge" id='{{"unread_badge_".$message->post_id}}'>
                                                            {{$message->unread}}
                                                        </div>
                                                        @endif
                                                    </div>
                                                </a>
                                            </li>
                                            {{-- @endif     --}}
                                            @empty

                                            @endforelse
                                        </ul>
                                    </li>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @auth
                    <!-- Remove d-none class with conditions -->
                    <div class="col-xl-5 mid-align-col-bx user-account-dropdownbx">
                        <div class="col-xl-5 mid-align-col-bx1">
                            <div class="btn-bx01">
                                <ul>
                                    <li class="orang-btnbx">
                                        <a class="{{ request()->route()->uri == 'posts' ? 'active' : '' }}"
                                            href="{{ route('posts.index') }}"><em>+</em> Post a Task</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-7 mid-align-col-bx2">
                            <div class="my-account-bx01">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="profile-bx1">
                                            <div class="profile-img"><img style="width:50px"
                                                    src="{{ auth()->user()->profile_image }}"></div>
                                            <div class="profile-detail">
                                                <h5>{{ !empty(auth()->user()->name) ? auth()->user()->name : auth()->user()->email }}
                                                </h5>
                                                <p class="userBalance">${{ !is_null(auth()->user()->balance) ?  auth()->user()->balance : 0}} USD</p>
                                            </div>
                                        </div>
                                    </button>
                                    <ul class="dropdown-menu user-dropdownbx p-2" aria-labelledby="dropdownMenuButton1">
                                        <!--<li>
                                            <a class="dropdown-item {{ request()->route()->uri == 'profile' ? 'active' : '' }}"
                                                href="{{ route('user.view.profile', auth()->user()->id) }}">View Profile </a>
                                                {{-- href="{{ route('profile.index') }}">View Profile </a> --}}
                                        </li>-->

                                        <li>
                                            <span><b>Account</b></span>
                                            <ul class="p-0" style="list-style: none;">
                                                <li>
                                                    <a class="dropdown-item {{ request()->route()->uri == 'profile' ? 'active' : '' }}"
                                                       href="{{ route('user.view.profile', auth()->user()->id) }}">
                                                        Profile
                                                    </a>
                                                </li>
                                                <!--<li>
                                                    <a class="dropdown-item {{ request()->route()->uri == 'profile' ? 'active' : '' }}"
                                                       href="{{ route('profile.profile_settings.index') }}#emailNotification">
                                                        Email & Notification
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item {{ request()->route()->uri == 'profile' ? 'active' : '' }}"
                                                       href="{{ route('profile.profile_settings.index') }}#password">
                                                    Password
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item {{ request()->route()->uri == 'profile' ? 'active' : '' }}"
                                                       href="{{ route('profile.profile_settings.index') }}#paymentFinancial">
                                                        Payment & Financials
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item {{ request()->route()->uri == 'profile' ? 'active' : '' }}"
                                                       href="{{ route('profile.profile_settings.index') }}#account">
                                                        Account
                                                    </a>
                                                </li>-->
                                                <li>
                                                    <a class="dropdown-item {{ request()->route()->uri == 'profile' ? 'active' : '' }}"
                                                       href="{{ route('profile.profile_settings.index') }}">
                                                        Settings
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li>
                                            <span><b>Finances</b></span>
                                            <ul class="p-0" style="list-style: none;">
                                                <li>
                                                    <a class="dropdown-item" href="{{route('stripe.connectBankAccount')}}">
                                                        Connect Bank Account
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item">
                                                        Balance: <span class="userBalanceMenu"><b>${{ !is_null(auth()->user()->balance) ?  auth()->user()->balance : 0}} USD</b></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{route('page.deposit')}}">
                                                        Add Funds
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{route('page.earnings')}}">
                                                        Withdraw Funds
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item">
                                                        Finance Overview
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li>
                                            <span><b>Other</b></span>
                                            <ul class="p-0" style="list-style: none;">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('page.support') }}">
                                                        Support
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item">
                                                        Invite Friends
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('auth.logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                                        Logout
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <!--<li>
                                            <a class="dropdown-item {{ request()->route()->uri == 'profile/settings' ? 'active' : '' }}"
                                                href="{{ route('profile.profile_settings.index') }}">Settings</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ request()->route()->uri == 'earnings' ? 'active' : '' }}"
                                                href="{{ route('page.earnings') }}">Earnings</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ request()->route()->uri == 'deposit' ? 'active' : '' }}"
                                                href="{{ route('page.deposit') }}">Deposit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ request()->route()->uri == 'supports' ? 'active' : '' }}"
                                                href="{{ route('page.support') }}">Support</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ request()->route()->uri == 'supports' ? 'active' : '' }}"
                                                href="{{ route('chat.users-fullscreen') }}">View Messages</a>
                                        </li>-->
                                        @if (my_posts()->contains(auth()->user()->id))
                                            <!--<li>
                                                <a class="dropdown-item {{ request()->route()->uri == 'supports' ? 'active' : '' }}"
                                                    href="{{ route('posts.my.posts') }}">My Projects</a>
                                            </li>-->
                                        @endif
                                        @if (my_projects()->contains(auth()->user()->id))
                                            <!--<li>
                                                <a class="dropdown-item {{ request()->route()->uri == 'supports' ? 'active' : '' }}"
                                                    href="{{ route('posts.my.jobs') }}">My Jobs</a>
                                            </li>-->
                                        @endif

                                        <!--<li>
                                            <a class="dropdown-item" href="{{ route('auth.logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a>
                                        </li>-->
                                        <form id="frm-logout" action="{{ route('auth.logout') }}" method="POST"
                                            style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mid-align-col-bx">
                        <div class="mobile-display2">
                            <div class="btn-bx01">
                                <ul>
                                    <li class="orang-btnbx">
                                        <a class="{{ request()->route()->uri == 'posts' ? 'active' : '' }}"
                                            href="{{ route('posts.index') }}"><em>+</em> Post Job</a>
                                    </li>
                                    <li class="white-btnbx">
                                        <a href="{{ route('auth.login.showform') }}">Login</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="icon-ulbx1 mobile-display">
                                <ul>
                                    <li>
                                        <a>
                                            <em id="notification_count">0</em>
                                            <i class="fa fa-bell-o" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
@if(count($category) > 0)
{{--    <div class="stellarnav">--}}
{{--        <ul>--}}
{{--            @foreach($category as $list)--}}
{{--                <li class="mega catFilter" data-column="8" id="categroy_{{$list['id']}}" data-id="{{$list['id']}}">--}}
{{--                    <a href="">{{$list['name']}}</a>--}}
{{--                    @if(count($list['subCategory']) > 0)--}}
{{--                        <ul>--}}
{{--                            @foreach($list['subCategory'] as $sList)--}}
{{--                                <li class="subCatFilter" id="subcategroy_{{$sList['id']}}" data-id="{{$sList['id']}}">--}}
{{--                                    <a href="#"><b>{{$sList['name']}}</b></a>--}}
{{--                                    @if(count($sList['getSkills']) > 0)--}}
{{--                                        <ul>--}}
{{--                                            @foreach($sList['getSkills'] as $skill)--}}
{{--                                                <li class="skillFilter" id="skill_{{$skill['id']}}" data-id="{{$skill['id']}}"><a href="#">{{$skill['name']}}</a></li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    @endif--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    @endif--}}
{{--            </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
@endif
