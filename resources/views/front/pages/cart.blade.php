@extends('front.layout')

@section('content')
    @include('front.inc.search')

    @include('front.inc.top-header')

    @include('front.inc.header')

    @include('front.inc.mobile-nav')


    <div id="page-content mt-5 container" >
       
     
        <div style="margin-top: 100px" class="d-flex justify-content-center">
            <h5>{{ __('front.cart') }}</h5>
        </div>




        <div class="row">
            <div class="col-12 col-md-8">
                <div class="row">
                    @if ($cartItems->count() > 0)
                   @foreach ($cartItems as $item )
                       <div class="col-6 col-md-4">
                             <a href="" class="d-block">
                                <img src="{{ asset('/uploads/' . $item->image) }}" width="100%" alt="{{ $item->name }}">
                             </a>
                             <div class="d-flex jsustify-content-center align-items-center flex-column p-2 " >
                                <p>{{ $item->product->name }}</p>
                             <p>{{ $item->price }} {{ $setting->currency_ar }} </p>
                             <p>{{ $item->quantity }}</p>

                             <a href="" class="btn btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                             </div>
                            
                       </div>
                   @endforeach
                @else
                    <p>there is no cart</p>
                @endif
                </div>
            </div>
        </div>



    </div>

    @include('front.inc.footer')
    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
    @include('front.inc.newsletter')
@endsection
