@extends('front.layout')

@section('content')
   

    @include('front.inc.top-header')

    @include('front.inc.header')


    <h3 class="bg-gray-200 py-4 text-center font-bold text-primary">{{ __('front.wishlist') }}</h3>
   <div class="container m-auto px-5">

  
   </div>



    @include('front.inc.footer')
  
@endsection
