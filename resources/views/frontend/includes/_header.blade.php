<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid ">
                <div class="header_bottom_border">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">

                                        <li><a href="{{ url('/') }}">home</a></li>
                                        <li><a href="{{ route('jobs.index') }}">Jobs</a></li>
                                        <li><a href="{{ route('seekers.index') }}">Seekers</a></li>
                                        <li><a href="{{ route('companies.index') }}">Companies</a></li>

                                        <li><a href="{{ route("posts.index") }}">Blog</a></li>
                                        <li><a href="#"> {{ trans('frontend.langs') }} <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode =>
                                                $properties)
                                                <li>
                                                    <a class="dropdown-item" rel="alternate"
                                                        hreflang="{{ $localeCode }}"
                                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                        {{ $properties['native'] }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @auth
                                        <li><a href="#">{{ auth()->user()->name }} <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li>
                                                    <a href="{{ route('profile') }}">Profile</a>
                                                </li>
                                                @role('seeker')

                                                <li>
                                                    <a href="{{ route('jobs.saved') }}">Saved Jobs ({{ user()->savedJobs->count() }})</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('jobs.applied') }}">Applied Jobs ({{ user()->appliedJobs->count() }})</a>
                                                </li>
                                                @endrole
                                                @role('company')
                                                <li>
                                                    <a
                                                        href="{{ route('company.users') }}">Company Admins</a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{ route('company.notifications') }}">Notifications ({{ auth()->user()->unreadNotifications->count() }})</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('company.jobs') }}">My Jobs ( {{ user()->jobs->count() }} )</a>
                                                </li>
                                                @endrole

                                                @permission('create_jobs')
                                                <li>
                                                    <a href="{{ route('jobs.create') }}">Add job</a>
                                                </li>
                                                @endpermission

                                                <li>
                                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">Logout</a>
                                                </li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>


                                            </ul>
                                        </li>
                                        @endauth
                                    </ul>
                                </nav>
                            </div>
                        </div>



                        @guest
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="Appointment">
                                <div class="phone_num d-none d-xl-block">
                                    <a href="{{ route('login') }}">{{ trans('frontend.login') }}</a>
                                </div>
                                <div class="d-none d-lg-block">
                                    <a class="boxed-btn3" href="{{ route('register') }}">Register</a>
                                </div>
                            </div>
                        </div>
                        @endguest

                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>