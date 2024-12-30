@extends('front.layout')
@section('content')
    @include('front.inc.top-header')
    @include('front.inc.header')
   


    <h2 class="bg-gray-300 text-black font-bold text-center py-10 my-10">{{ __('front.login') }}</h2>
    <div class="container m-auto px-3">
        <div class="w-full md:w-1/2 m-auto my-10">
           
            <form method="post" action="{{ route('login') }}" id="CustomerLoginForm" accept-charset="UTF-8"
                class="contact-form">
                @csrf
                <div class="row">
                    

                    <div class="mb-4">
                        <div >
                            <label class="text-sm block">{{ __('front.email') }}</label>
                            <input type="email" name="email" 
                                class="input w-full @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">
                        </div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="mb-4">
                        <div>
                            <label class="text-sm block">{{ __('front.password') }}</label>
                            <input type="password" class="input w-full @error('password') is-invalid @enderror"
                                 name="password" required autocomplete="new-password">
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="flex justify-center">
                    <button class="primary-button" type="submit">{{ __('front.login') }}</button>
                </div>

                <div class="flex justify-center my-3">
                    
                    <a href="{{ route('register') }}">{{ __(('front.register')) }}</a>
                </div>
            </form>
        </div>
    </div>

   
    @include('front.inc.footer')
@endsection