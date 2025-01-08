@extends('front.layout')

@section('content')
   

    @include('front.inc.top-header')

    @include('front.inc.header')

 


    <div class="container px-10 my-10">
      <div class="grid grid-cols-2 md:grid-cols-3 gap-5 items-center justify-center">
        <div class="border p-5 flex items-center justify-center flex-col border-primary rounded-lg">
            <i class="bi bi-telephone-fill text-3xl text-primary"></i>
            <p class="mt-10">{{$setting->phone}}</p>
        </div>

        <div class="border p-5 flex items-center justify-center flex-col border-primary rounded-lg">
            <i class="bi bi-whatsapp text-3xl text-primary"></i>
            <p class="mt-10">{{$setting->whatsapp}}</p>
        </div>

        <div class="border p-5 flex items-center justify-center flex-col border-primary rounded-lg">
            <i class="bi bi-envelope text-3xl text-primary"></i>
            <p class="mt-10">{{$setting->email}}</p>
        </div>

      </div>
    </div>

    @include('front.inc.footer')


@endsection
