<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">

        <div class="sidebar-brand">
            <a href="index.html">

                @if ($setting->logo)
                    <img alt="image" src="{{ asset('/uploads/' . $setting->logo) }}" alt="{{ $setting->description }}"
                        class="header-logo" />
                @endif
                <span class="logo-name " style="font-size: 12px">

                    @if (app()->getLocale() == 'en')
                        {{ $setting->name_en }}
                    @else
                        {{ $setting->name_ar }}
                    @endif
                </span>
            </a>
        </div>

        <ul class="sidebar-menu">



            <li class="dropdown ">
                <a href="{{ route('visit.website') }}" class="nav-link" target="_blank">
                    <i class="fas fa-cog"></i>
                    <span>{{ __('translate.visit-website') }}</span></a>
            </li>


            <li class="dropdown ">
                <a href="{{ route('setting.page') }}" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>{{ __('translate.setting') }}</span></a>
            </li>



            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fas fa-project-diagram"></i><span>{{ __('translate.categories') }}</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link"
                            href="{{ route('categories.page') }}">{{ __('translate.main_categories') }}</a></li>

                </ul>
            </li>


            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fab fa-product-hunt"></i>
                    <span>{{ __('translate.products') }}</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('add.product.page') }}">
                            {{ __('translate.add-new-product') }}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('show.products.page') }}">
                            {{ __('translate.show-products') }}
                        </a>
                    </li>

                </ul>
            </li>





            <li class="dropdown ">
                <a href="{{ route('admin.cart.page.control') }}" class="nav-link">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>{{ __('products.cart') }}</span></a>
            </li>


            <li class="dropdown">
                <a href="{{ route('countries.page') }}" class="nav-link">
                    <i class="fa-solid fa-globe"></i>
                    <span>{{ __('countries.countries') }}</span></a>
            </li>




            <li class="dropdown ">
                <a href="{{ route('slider.page') }}" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>{{ __('translate.slider-page') }}</span></a>
            </li>


            <li class="dropdown ">
                <a href="{{ route('payment.page') }}" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>{{ __('translate.payment') }}</span></a>
            </li>

            <li class="dropdown ">
                <a href="{{ route('media.library.page') }}" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>{{ __('translate.media-library') }}</span></a>
            </li>




            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown">
                    <i class="fab fa-product-hunt"></i>
                    <span>{{ __('translate.orders') }}</span></a>

                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('show.orders.page') }}">
                            {{ __('translate.completed-orders') }}
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{{ route('show.products.page') }}">
                            {{ __('translate.non-completed-orders') }}
                        </a>
                    </li>

                </ul>
            </li>





        </ul>
    </aside>
</div>
