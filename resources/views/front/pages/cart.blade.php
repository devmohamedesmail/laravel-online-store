@extends('front.layout')

@section('content')
    @include('front.inc.search')

    @include('front.inc.top-header')

    @include('front.inc.header')

    @include('front.inc.mobile-nav')


    <div id="page-content">
       
 cart page
    </div>

    @include('front.inc.footer')
    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
    @include('front.inc.newsletter')
@endsection
