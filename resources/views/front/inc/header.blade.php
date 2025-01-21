<header class=" bg-white  p-3 z-50">
    <div class="container m-auto">
        <div class="flex justify-between items-center">
            <div>

                <a href="{{ route('user.index') }}">
                    <img src="{{ asset('/uploads/' . $setting->logo) }}" alt="{{ $setting->name }}" width="90px">
                </a>
            </div>



            <div class="menu-navbar">

                <button id="menu-toggle" class="bg-white border-0 text-black md:hidden">
                    <i class="bi bi-list text-xl"></i>
                </button>

                <!-- Navigation Menu -->
                <nav id="menu"
                    class="absolute hidden md:block bg-white md:static z-10 w-full md:w-auto left-0 transition-all duration-300">
                    <ul class="flex flex-col md:flex-row md:items-center md:space-x-4">
                       
                       
                        <li>
                            <a class="block px-4 py-2 text-black hover:bg-primary rounded-md hover:text-white transition-all ease-in-out duration-1000 text-sm"
                                href="{{ route('user.index') }}">{{ __('front.home') }}
                            </a>
                        </li>

                        <li>
                            <a class="block px-4 py-2 text-black hover:bg-primary rounded-md hover:text-white transition-all ease-in-out duration-1000 text-sm"
                                href="{{ route('shop.page') }}">{{ __('front.shop') }}
                            </a>
                        </li>





                        <li class="relative group">
                            <a class="block px-4 py-2 text-black hover:bg-primary rounded-md hover:text-white transition-all ease-in-out duration-1000 text-sm"
                                href="{{ route('user.index') }}">{{ __('front.categories') }}
                            </a>

                            <ul class="absolute hidden group-hover:block bg-white shadow-lg left-0 top-full w-48">



                                @foreach ($categories as $category)
                                    <li><a class="block px-4 py-2 text-black hover:bg-primary rounded-md hover:text-white transition-all ease-in-out duration-1000 text-sm" href="#">
                                            {{ $category->name }}
                                        </a></li>
                                @endforeach
                            </ul>
                        </li>



                        <li>
                            <a class="block px-4 py-2 text-black hover:bg-primary rounded-md hover:text-white transition-all ease-in-out duration-1000 text-sm"
                                href="{{ route('contact.page') }}">
                                {{ __('front.contact-us') }}
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>


            <div class=" hidden md:flex">

                <div class="relative mx-1">
                    <a href="{{ route('cart.page') }}"><i class="bi bi-cart2 text-black text-2xl"></i></a>
                    <span
                        class="absolute top-0 right-0 w-4 h-4 flex items-center justify-center text-xs font-bold text-white bg-black rounded-full">{{ $cartItems->count() }}</span>
                </div>
                <div class="relative mx-1">
                    <a href=""><i class="bi bi-suit-heart text-black text-2xl"></i></a>
                    <span
                        class="absolute top-0 right-0 w-4 h-4 flex items-center justify-center text-xs font-bold text-white bg-black rounded-full">{{ $cartItems->count() }}</span>
                </div>

            </div>
        </div>
    </div>



    <div class="container m-auto mt-3">
     
        <form action="{{ route('product.search') }}" method="GET">
            @csrf
            <div class="flex items-center justify-center w-full md:w-1/2 m-auto ">
                <input type="search" name="search" class="px-2 flex-1 focus:border-primary border h-10 focus:outline-none"
                    placeholder="{{ __('front.search') }}" id="">
                <button class="bg-primary text-white px-2 h-10 w-10"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>
</header>
