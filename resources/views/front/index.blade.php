@extends('front.layout')

@section('content')
    @include('front.inc.top-header')
    {{-- @include('front.inc.header') --}}


    {{-- @include('front.inc.slidershow') --}}

    <header class="hero  h-[40vh] sm:h-[30vh] lg:h-[90vh]   bg-no-repeat bg-cover"
        style="background-image: url('/templates/front/images/negley-stockman-mJQ9sam4r6w-unsplash (1).jpg')">
       

  

        <div class="flex items-center justify-between px-4 py-2 bg-white bg-opacity-50 h-20 sticky top-0 z-50">
            <div>
                <a href="{{ route('user.index') }}">
                    <img src="{{ asset('/uploads/' . $setting->logo) }}" width="100px" alt="{{ $setting->name }}">
                </a>
            </div>
    
    
    
            <div class="menu-navbar">
    
                <button id="menu-toggle" class=" border-0 text-black md:hidden">
                    <i class="bi bi-list text-2xl"></i>
                </button>
    
                <!-- Navigation Menu -->
                <nav id="menu"
                    class="absolute hidden md:block  md:static z-10 w-full md:w-auto left-0 transition-all duration-300">
                    <ul class="flex flex-col md:flex-row md:items-center md:space-x-4 bg-white md:bg-transparent">
                       
                        <li>
                            <a class="block px-4 py-2 text-black hover:border-b-2 border-b-primary transition-all ease-in-out duration-1000 text-sm"
                                href="{{ route('user.index') }}">{{ __('front.home') }}
                            </a>
                        </li>
    
                        <li>
                            <a class="block px-4 py-2 text-black hover:border-b-2 border-b-primary transition-all ease-in-out duration-1000 text-sm"
                                href="{{ route('shop.page') }}">{{ __('front.shop') }}
                            </a>
                        </li>
    
    
    
    
    
                        <li class="relative group">
                            <a class="block px-4 py-2 text-black hover:border-b-2 border-b-primary transition-all ease-in-out duration-1000 text-sm"
                                href="{{ route('user.index') }}">{{ __('front.categories') }}
                            </a>
    
                            <ul class="absolute hidden group-hover:block bg-white shadow-lg left-0 top-full w-48">
    
    
    
                                @foreach ($categories as $category)
                                    <li><a class="block px-4 py-2 text-black hover:border-b-2 hover:bg-primary hover:text-white transition-all ease-in-out duration-1000 text-sm" href="#">
                                            {{ $category->name }}
                                        </a></li>
                                @endforeach
                            </ul>
                        </li>
    
    
    
                        <li>
                            <a class="block px-4 py-2 text-black hover:border-b-2 border-b-primary transition-all ease-in-out duration-1000 text-sm"
                                href="{{ route('contact.page') }}">
                                {{ __('front.contact-us') }}
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class=" mt-20  flex flex-col justify-center items-center">
            <h2 class="text-center text-2xl font-bold text-white">Fish Restaurant</h2>
        </div>
    </header>
    @include('front.inc.categories-section')
    @include('front.inc.banners')
    @include('front.inc.products')


    @include('front.inc.footer')
    @include('front.inc.bottom-navbar')
@endsection
