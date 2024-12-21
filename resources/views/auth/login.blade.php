@extends('front.layout')
@section('content')
    @include('front.inc.top-header')
    @include('front.inc.header')
    @include('front.inc.mobile-nav')

    <div id="page-content">

        <div class="page section-header text-center mt-5">
            <div class="page-title">
                <div class="wrapper">
                    <h1 class="page-width">Login To Account</h1>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                    <div class="mb-4">
                        <form method="post" action="{{ route('login') }}" id="CustomerLoginForm" accept-charset="UTF-8"
                            class="contact-form">
                            @csrf
                            <div class="row">
                                

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="CustomerEmail">Email</label>
                                        <input type="email" name="email" id="CustomerEmail"
                                            class="@error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">
                                    </div>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="CustomerPassword">Password</label>
                                        <input type="password" class="@error('password') is-invalid @enderror"
                                            id="CustomerPassword" name="password" required autocomplete="new-password">
                                    </div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input type="submit" class="btn mb-3" value="Login">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('front.inc.footer')
@endsection