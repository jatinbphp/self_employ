<header class="header-bx02">
    <div class="header-bx01">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3">
                    <div class="logo">
                        <a href="{{ route('home.index') }}">
                            <img src="{{ asset('assets/images/logo2.png') }}">
                        </a>
                    </div>
                </div>
                <div class="col-xl-5">
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
                                            <a class="nav-link {{ request()->route()->uri == 'categories' ? 'active' : '' }}"
                                                aria-current="page" href="{{ route('page.categories') }}">Categories</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a class="nav-link {{ request()->route()->uri == 'howitworks' ? 'active' : '' }}"
                                                href="{{ route('page.how.it.works') }}">How Its Works</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->route()->uri == 'selfemployment' ? 'active' : '' }}"
                                                href="{{ route('page.why.self.employee') }}">Why Self Employ</a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <div class="icon-ulbx1 desktop-displaybx1">
                            <ul>
                                 <li><a href="#"><em>0</em><i class="fa fa-bell-o" aria-hidden="true"></i></a></li>
                                 <li><a href="#"><em>10</em><i class="fa fa-comment-o" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @auth
                    <!-- Remove d-none class with conditions -->
                    <div class="col-xl-4 mid-align-col-bx">
                        <div class="col-xl-6 mid-align-col-bx1">
                            <div class="btn-bx01">
                                <ul>
                                    <li class="orang-btnbx">
                                        <a class="{{ request()->route()->uri == 'posts' ? 'active' : '' }}"
                                            href="{{ route('posts.index') }}"><em>+</em> Post a Task</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 mid-align-col-bx2">
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
                                                <p>{{ auth()->user()->designation }}</p>
                                            </div>
                                        </div>
                                    </button>
                                    <ul class="dropdown-menu user-dropdownbx" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a class="dropdown-item {{ request()->route()->uri == 'profile' ? 'active' : '' }}"
                                                href="{{ route('profile.index') }}">View Profile </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ request()->route()->uri == 'profile/settings' ? 'active' : '' }}"
                                                href="{{ route('profile.profile_settings.index') }}">Settings</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ request()->route()->uri == 'earnings' ? 'active' : '' }}"
                                                href="{{ route('page.earnings') }}">Earnings</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ request()->route()->uri == 'supports' ? 'active' : '' }}"
                                                href="{{ route('page.support') }}">Support</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item {{ request()->route()->uri == 'supports' ? 'active' : '' }}"
                                                href="{{ route('chat.users') }}">View Messages</a>
                                        </li>
                                        @if (my_posts()->contains(auth()->user()->id))
                                            <li>
                                                <a class="dropdown-item {{ request()->route()->uri == 'supports' ? 'active' : '' }}"
                                                    href="{{ route('posts.my.posts') }}">My Jobs</a>
                                            </li>
                                        @endif

                                        <li>
                                            <a class="dropdown-item" href="{{ route('auth.logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a>
                                        </li>
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
                    <!-- Before Login Fields -->
                    <div class="col-xl-3 mid-align-col-bx">
                        <div class="mobile-display2">
                            <div class="btn-bx01">
                                <ul>
                                    <li class="orang-btnbx"><a class="{{ request()->route()->uri == 'posts' ? 'active' : '' }}"
                                            href="{{ route('posts.index') }}"><em>+</em> Post a Task</a></li>
                                    <li class="white-btnbx"><a href="{{ route('auth.login.showform') }}">Login</a></li>
                                </ul>
                            </div>
                            <div class="icon-ulbx1 mobile-display">
                                <ul>
                                    <li><a href="#"><em>0</em><i class="fa fa-bell-o" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><em>10</em><i class="fa fa-comment-o" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- After Login Fields -->
                @endauth
            </div>
        </div>
    </div>
</header>
