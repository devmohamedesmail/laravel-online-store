@extends('front.layout')

@section('content')
    @include('front.inc.top-header')
    @include('front.inc.header')


    @include('front.inc.slidershow')
    @include('front.inc.categories-section')
    @include('front.inc.products')
    

    @include('front.inc.footer')
    @include('front.inc.bottom-navbar')
 
@endsection
