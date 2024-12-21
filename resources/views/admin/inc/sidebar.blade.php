<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">
                
                 @if ($setting->logo)
                 <img alt="image" src="/uploads/setting/{{ $setting->logo }}" alt="{{ $setting->description }}" class="header-logo" /> 
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
            <li class="menu-header">Main</li>


            <li class="dropdown active">
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





            <li class="dropdown active">
                <a href="{{ route('admin.cart.page.control') }}" class="nav-link">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>{{ __('products.cart') }}</span></a>
            </li>


            <li class="dropdown active">
                <a href="{{ route('countries.page') }}" class="nav-link">
                    <i class="fa-solid fa-globe"></i>
                    <span>{{ __('countries.countries') }}</span></a>
            </li>






        </ul>
    </aside>
</div>
