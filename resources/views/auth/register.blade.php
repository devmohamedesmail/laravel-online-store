@extends('front.layout')
@section('content')
    @include('front.inc.top-header')
    @include('front.inc.header')
  

   
    <h2 class="bg-gray-300 text-black font-bold text-center py-10 my-10">{{ __('front.register') }}</h2>

    <div class="container m-auto px-2">
        <div class="mb-4 w-full md:w-1/2 m-auto">
            <form method="post" action="{{ route('register') }}" id="CustomerLoginForm" accept-charset="UTF-8"
                class="contact-form">
                @csrf
                <div class="row">
                    <div class="mb-3">
                        <div >
                            <label class="text-sm block" > {{ __('front.name') }}</label>
                            <input type="text" name="name" placeholder="" id="FirstName"
                                class="input w-full @error('name') is-invalid @enderror" value="{{ old('name') }}" required
                                autocomplete="name" autofocus>
                        </div>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div >
                            <label class="text-sm block">{{ __('front.email') }}</label>
                            <input type="email" name="email" id="CustomerEmail"
                                class="input w-full @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">
                        </div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div cclass="mb-3">
                        <div >
                            <label class="text-sm block">{{ __('front.password')  }}</label>
                            <input type="password" class="input w-full @error('password') is-invalid @enderror"
                                id="CustomerPassword" name="password" required autocomplete="new-password">
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="my-5">
                   
                    <button type="submit" class="primary-button">{{ __('front.register') }}</button>
                </div>
                <div class="flex justify-center my-2">
                    <a href="{{ route('login') }}">{{ __('front.login') }}</a>
                </div>
            </form>
        </div>
    </div>
    @include('front.inc.footer')
@endsection
