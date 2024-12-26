@extends('front.layout')

@section('content')
    @include('front.inc.search')

    @include('front.inc.top-header')

    @include('front.inc.header')

    @include('front.inc.mobile-nav')


    <!--Body Content-->
    <div id="page-content">
        @include('front.inc.slidershow')
        @include('front.inc.categories-section')
        @include('front.inc.products')
        @include('front.inc.product-slider')




        
     
 
    </div>

    @include('front.inc.footer')
 
    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
  

    @include('front.inc.newsletter')
    <!-- End Newsletter Popup -->
@endsection
