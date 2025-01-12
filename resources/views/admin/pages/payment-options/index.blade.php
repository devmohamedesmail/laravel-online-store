@extends('admin.layout')

@section('content')
    <div class="main-content">

        <h6 class="row bg-white text-dark p-2">
            {{ __('translate.add-payment-method') }}
        </h6>




        <div class="bg-white ">
            <ul class="nav nav-tabs " id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">{{ __('translate.payment') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">{{ __('translate.payment-setting') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="false">Contact</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('admin.pages.payment-options.parts.payment-options')
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @include('admin.pages.payment-options.parts.payment-setting')
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>
        </div>





        @include('admin.inc.setting')
    </div>
@endsection
