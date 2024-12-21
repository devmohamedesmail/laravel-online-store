<div class="header-wrap classicHeader animated d-flex mb-3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!--Desktop Logo-->
            <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                <a href="{{ route('user.index') }}">
                    <img src="/uploads/setting/{{ $setting->logo }}" alt="{{ $setting->name }}"
                        title="{{ $setting->name }}" />
                </a>
            </div>
            <!--End Desktop Logo-->
            <div class="col-2 col-sm-3 col-md-3 col-lg-8">
                <div class="d-block d-lg-none">
                    <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                        <i class="icon anm anm-times-l"></i>
                        <i class="anm anm-bars-r"></i>
                    </button>
                </div>
                <!--Desktop Menu-->
                <nav class="grid__item" id="AccessibleNav"><!-- for mobile -->
                    <ul id="siteNav" class="site-nav medium center hidearrow">
                        <li class="lvl1 parent megamenu"><a href="{{ route('user.index') }}">{{ __('front.home') }} <i
                                    class="anm anm-angle-down-l"></i></a>

                        </li>


                        <li class="lvl1 parent dropdown"><a href="#">{{ __('front.categories') }} <i
                                    class="anm anm-angle-down-l"></i></a>
                            <ul class="dropdown">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="cart-variant1.html" class="site-nav">
                                            {{ $category->name }}
                                            
                                            <i
                                                class="anm anm-angle-right-l"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="cart-variant1.html" class="site-nav">Cart Variant1</a></li>
                                            <li><a href="cart-variant2.html" class="site-nav">Cart Variant2</a></li>
                                        </ul>
                                    </li>
                                @endforeach




                            </ul>
                        </li>

                        <li class="lvl1 parent dropdown"><a href="#">Blog <i class="anm anm-angle-down-l"></i></a>
                            <ul class="dropdown">
                                <li><a href="blog-left-sidebar.html" class="site-nav">Left Sidebar</a></li>
                                <li><a href="blog-right-sidebar.html" class="site-nav">Right Sidebar</a></li>
                                <li><a href="blog-fullwidth.html" class="site-nav">Fullwidth</a></li>
                                <li><a href="blog-grid-view.html" class="site-nav">Gridview</a></li>
                                <li><a href="blog-article.html" class="site-nav">Article</a></li>
                            </ul>
                        </li>

                        <li class="lvl1"><a href="{{ route('contact.page') }}"><b> {{ __('front.contact') }}</b> <i class="anm anm-angle-down-l"></i></a>
                        </li>
                    </ul>
                </nav>
                <!--End Desktop Menu-->
            </div>
            <!--Mobile Logo-->
            <div class="col-6 col-sm-6 col-md-6 col-lg-2 d-block d-lg-none mobile-logo">
                <div class="logo">
                    <a href="{{ route('user.index') }}">
                        <img src="/public/uploads/setting/{{ $setting->logo }}" alt="{{ $setting->name }}"
                            title="{{ $setting->name }}" />
                    </a>
                </div>
            </div>
            <!--Mobile Logo-->
            <div class="col-4 col-sm-3 col-md-3 col-lg-2">
                <div class="site-cart">
                   

                    <a href="{{ route('cart.page') }}" >
                    
                        <i class="icon anm anm-bag-l fs-2 text-dark"></i>
                    </a>

                </div>
               
                <div class="site-header__search">
                    <button type="button" class="search-trigger"><i class="icon anm anm-search-l"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
