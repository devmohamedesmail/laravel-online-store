
<div class="bg-black py-2">
    <div class="container m-auto">
     <div class="flex justify-between items-center">
        <div class="relative inline-block text-left">
            <div>
                <button type="button"
                    class="inline-flex w-full justify-center text-white border-0 text-sm"
                    id="menu-button" aria-expanded="false" aria-haspopup="true" onclick="toggleDropdown()">
                       {{ LaravelLocalization::getCurrentLocaleNative() }}


                    <i class="bi bi-chevron-down mx-1"></i>

                </button>
            </div>

            <div id="dropdown-menu z-50"
                class="hidden absolute right-0 z-50 mt-1 w-fit px-2 py-1 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <div class="py-1 flex flex-col jsutify-center items-center py-3" role="none">

                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="text-dark block py-2 text-sm" rel="alternate" hreflang="{{ $localeCode }}"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    @endforeach

                </div>
            </div>
        </div>






        <div class="flex">
            @guest
                <a class="text-white mx-1 font-bold" href="{{ route('login') }}">{{ __('front.login') }}</a>
                <a class="text-white mx-1 font-bold" href="{{ route('register') }}">{{ __('front.register') }}</a>
            @else
                <p class="text-white">{{ Auth::user()->name }}</p>
                
                <a href="{{ route('logout') }}" class="text-white mx-1 font-bold"
                  onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>



            @endguest
        </div>

        <script>
            function toggleDropdown() {
                const menu = document.getElementById('dropdown-menu');
                const isHidden = menu.classList.contains('hidden');
                menu.classList.toggle('hidden', !isHidden); // Toggle the `hidden` class
            }

            // Optional: Close dropdown if clicked outside
            window.addEventListener('click', (event) => {
                const menu = document.getElementById('dropdown-menu');
                const button = document.getElementById('menu-button');
                if (!menu.contains(event.target) && !button.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });
        </script>
     </div>

    </div>
</div>
