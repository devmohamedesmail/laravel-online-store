<div class="mobile-nav-wrapper" role="navigation">

    <div class="closemobileMenu py-4">
        <i class="icon anm anm-times-l pull-right bg-danger p-2 text-white"></i>
    </div>

    <ul id="MobileNav" class="mobile-nav">
        <li class="lvl1 parent megamenu">
            <a href="{{ route('user.index') }}">{{ __('front.home') }}

            </a>

        </li>

        <li class="lvl1 parent megamenu">
            <a href="{{ route('user.index') }}">{{ __('front.home') }}

            </a>
        </li>

        <li class="lvl1 parent megamenu"><a href="#">
                {{ __('front.categories') }}
                <i class="anm anm-plus-l"></i></a>
            <ul>
                @foreach ($categories as $category)
                    <li><a href="#" class="site-nav">{{ $category->name }}<i class="anm anm-plus-l"></i></a>

                    </li>
                @endforeach
            </ul>
        </li>

        <li class="lvl1"><a href="{{ route('contact.page') }}"><b>{{ __('front.contact') }}</b></a>
        </li>
    </ul>
</div>
