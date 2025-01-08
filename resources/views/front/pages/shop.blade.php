@extends('front.layout')

@section('content')
 

    @include('front.inc.top-header')

    @include('front.inc.header')



    <div class="container m-auto px-3">
     <div class="grid grid-cols-2 md:grid-cols-6 m-auto  gap-5">
        @foreach ($products as $product)
        <div class="product-card">

            <div class="relative">
                <a href="{{ route('product.details', [$product->id, $product->slug ?? '']) }}" class="block ">
                    <img src="/uploads/{{ $product->image }}" width="100%" alt="{{ $product->name }}">


                </a>
                <a href="{{ route('product.details', [$product->id, $product->slug ?? '']) }}"
                    class="absolute bottom-0 left-0 right-0 text-center py-2 bg-primary text-white no-underline">
                    <i class="bi bi-bag"></i>
                  <span class="mx-1 text-sm">  {{ __('front.add-to-cart') }}</a></span>
            </div>

            <p class="text-center font-bold mt-2"> {{ $product->name }}</p>

            <div class="flex items-center justify-center">


                @if ($product->sale_price)
                    <p class="text-center bold mt-2 line-through text-xs text-red-600 mx-1"> {{ $product->price }}
                        @if (app()->getLocale() == 'ar')
                            {{ $setting->currency_ar }}
                        @else
                            {{ $setting->currency_en }}
                        @endif
                    </p>
                    <p class="text-center bold mt-2 mx-1 font-bold text-primary"> {{ $product->sale_price }}

                        @if (app()->getLocale() == 'ar')
                            {{ $setting->currency_ar }}
                        @else
                            {{ $setting->currency_en }}
                        @endif
                    </p>
                @else
                    <p class="text-center font-bold mt-2"> {{ $product->price }}

                        @if (app()->getLocale() == 'ar')
                            {{ $setting->currency_ar }}
                        @else
                            {{ $setting->currency_en }}
                        @endif
                    </p>
                @endif
            </div>

        </div>
        @endforeach
     </div>
    </div>

 


 

    @include('front.inc.footer')
    @include('front.inc.bottom-navbar')
   
@endsection
