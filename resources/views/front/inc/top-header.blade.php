<div class="top-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-10 col-sm-8 col-md-5 col-lg-4">
                
                <div class="language-dropdown">
                    <span class="language-dd">
                        {{ LaravelLocalization::getCurrentLocaleNative() }}
                    </span>
                    <ul id="language">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a class="text-dark" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>



                </div>
                
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
                <div class="text-center">
                    <p class="top-header_middle-text">
                        {{ __('front.top-header-message') }}
                    </p>
                </div>
            </div>
            <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
                <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
                <ul class="customer-links list-inline">

                    <li><a href="{{ route('wishlist') }}">{{ __('front.wishlist') }}</a></li>





                    @guest
                        <li><a href="{{ route('login') }}">{{ __('front.login') }}</a></li>
                        <li><a href="{{ route('register') }}">{{ __('front.register') }}</a></li>
                    @else
                     


                        <li><a href="#">{{ Auth::user()->name }}</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        </li>


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>



                    @endguest









                </ul>
            </div>



        </div>
    </div>
</div>
