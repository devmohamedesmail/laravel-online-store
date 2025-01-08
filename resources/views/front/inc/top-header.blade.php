
<div class="bg-black py-2">
    <div class="container m-auto px-10">
     <div class="flex justify-between items-center">
    


        <div class="relative inline-block text-left z-50" style="z-index: 10000">
            <div>
                <button type="button"
                    class="inline-flex w-full justify-center text-white border-0 text-sm"
                    id="menu-button" aria-expanded="false" aria-haspopup="true">
                    {{ LaravelLocalization::getCurrentLocaleNative() }}
                    <i class="bi bi-chevron-down mx-1"></i>
                </button>
            </div>
        
            <div id="dropdown-menu"
                class="hidden absolute right-0 z-50 mt-1 w-fit px-2  py-1 origin-top-right rounded-md  bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <div class="py-1 flex flex-col justify-center items-center z-50   " role="none">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="text-dark block py-2 text-sm  w-full" rel="alternate" hreflang="{{ $localeCode }}"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>



        <div class="flex">
            @guest
                <a class="text-white mx-1 text-sm" href="{{ route('login') }}">{{ __('front.login') }}</a>
                <a class="text-white mx-1 text-sm" href="{{ route('register') }}">{{ __('front.register') }}</a>
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

        
     </div>

    </div>
</div>




<script>
    // Dropdown toggle logic
    document.getElementById('menu-button').addEventListener('click', function () {
        const dropdownMenu = document.getElementById('dropdown-menu');
        const isHidden = dropdownMenu.classList.contains('hidden');
        dropdownMenu.classList.toggle('hidden', !isHidden);
        this.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
    });

    // Close dropdown on outside click
    document.addEventListener('click', function (event) {
        const dropdownMenu = document.getElementById('dropdown-menu');
        const button = document.getElementById('menu-button');
        if (!button.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
            button.setAttribute('aria-expanded', 'false');
        }
    });
</script>
