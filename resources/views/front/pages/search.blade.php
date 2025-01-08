@extends('front.layout')

@section('content')
    @include('front.inc.top-header')
    @include('front.inc.header')


    <div class="container m-auto my-10">
        <h1 class="text-2xl font-bold text-center mb-4">Search Results for "{{ $query }}"</h1>
        @if ($products->isEmpty())
            <p class="text-center bg-gray-200 p-4">{{__('translate.no_result')}}</p>
        @else
            <div class="flex justify-center flex-col items-center">
                @foreach ($products as $product)
                    <div class="border flex  my-1 w-full md:w-1/2">
                        <a href="{{ route('product.details', [$product->id, $product->slug ?? '']) }}') }}">
                            <img src="{{ asset('/uploads/' . $product->image) }}" class="w-28 h-28" alt="">
                        </a>
                        <div class="mx-2">
                            <h2 class="text-lg font-semibold ">{{ $product->name }}</h2>
                            <p>{{ $product->description }}</p>
                            <p class="text-primary font-bold">
                                {{ $product->price }}
                            
                               @if (app()->getLocale() == 'en')
                                   {{ $setting->currency_en }}
                               @else
                               {{ $setting->currency_ar }}
                               @endif
                            
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>


    @include('front.inc.footer')
    @include('front.inc.bottom-navbar')

@endsection
