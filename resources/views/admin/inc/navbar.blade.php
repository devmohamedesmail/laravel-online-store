<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i
                        data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a></li>
            <li>

            </li>
        </ul>
    </div>




    <ul class="navbar-nav navbar-right">


        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg text-dark">
                {{ LaravelLocalization::getCurrentLocaleNative() }}
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">

               



                <ul style="list-style-type: none;">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>



            </div>
        </li>

        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image"
                    src="/templates/admin/assets/img/user.png" class="user-img-radious-style"> <span
                    class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">Hello Sarah Smith</div>
                <a href="profile.html" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
                </a> <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                    Activities
                </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                    Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="auth-login.html" class="dropdown-item has-icon text-danger"> <i
                        class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
