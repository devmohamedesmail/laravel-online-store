@extends('front.layout')

@section('content')
    @include('front.inc.top-header')

    @include('front.inc.header')




    @if (session('success'))
        <script>
            iziToast.success({
                title: 'Success',
                message: '{{ session('success') }}',
                position: 'topRight',
                timeout: 3000
            });
        </script>
    @endif

    <h4 class="bg-gray-200 py-6 text-center text-xl">
        {{ __('front.cart') }}</h4>


     @if ($cartItems->count() > 0)
     <div class="container m-auto px-5">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 my-10">
            <div class="col-span-8  ">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2 overflow-hidden">
                    @foreach ($cartItems as $item)
                        <div class="border border-gray-300 rounded-md">
                            <a href="{{ route('product.details', [$item->product->id, $item->product->slug ?? '']) }}"
                                class="overflow-hidden block h-60">
                                <img src="{{ asset('/uploads/' . $item->product->image) }}" alt="{{ $item->name }}">
                            </a>
                            <div class="p-2">

                                <p class="text-center text-xs">
                                    {{ \Illuminate\Support\Str::words($item->product->name, 5, '...') }} </p>

                                @if ($item->product->sale_price !== null)
                                    <div class="flex justify-center">
                                        <p class="mx-1">{{ $item->product->sale_price }}

                                            @if (app()->getLocale() == 'ar')
                                                {{ $setting->currency_ar }}
                                            @else
                                                {{ $setting->currency_en }}
                                            @endif
                                        </p>
                                        <p class="mx-1 line-through text-gray-500">{{ $item->product->price }}

                                            @if (app()->getLocale() == 'ar')
                                                {{ $setting->currency_ar }}
                                            @else
                                                {{ $setting->currency_en }}
                                            @endif
                                        </p>
                                    </div>
                                @else
                                    <p class="text-center text-primary">{{ $item->product->price }}

                                        @if (app()->getLocale() == 'ar')
                                            {{ $setting->currency_ar }}
                                        @else
                                            {{ $setting->currency_en }}
                                        @endif
                                    </p>
                                @endif




                                <div class="flex justify-between ">
                                    <div class="bg-gray-200 p-1 rounded-full ">
                                        <button hx-post="{{ route('cart.increase', $item->id) }}"  class="mx-3"
                                            hx-target="#quantity-{{ $item->id }}" hx-swap="outerHTML" hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'>
                                            <i class="bi bi-plus"></i>
                                        </button>
                                        <span id="quantity-{{ $item->id }}"
                                            class="w-20 text-center focus:outline-none bg-transparent">
                                            {{ $item->quantity }}
                                        </span>
                                        <button hx-post="{{ route('cart.decrease', $item->id) }}" class="mx-3"
                                            hx-target="#quantity-{{ $item->id }}" hx-swap="outerHTML" hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'>
                                            <i class="bi bi-dash"></i>
                                        </button>
                                    </div>

                                    <a href="{{ route('cart.delete', $item->id) }}"
                                        class="bg-red-500 p-1 rounded-full w-7 h-7 flex justify-center items-center"><i
                                            class="bi bi-trash text-white"></i></a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-span-12 md:col-span-4  p-2" id="cart-total-section">
                <h4 class="bg-gray-200 py-6 text-center text-xl w-full mb-3">{{ __('front.cart-content') }}</h4>
                <?php $total = 0; ?>
                @foreach ($cartItems as $item)
                    <div class="flex justify-between items-center my-2">
                        <p class="text-xs">{{ $item->product->name }}</p>

                        @if ($item->product->sale_price !== null)
                            <p class="text-red-500 text-nowrap">{{ $item->quantity * $item->product->sale_price }}

                                @if (app()->getLocale() == 'ar')
                                    {{ $setting->currency_ar }}
                                @else
                                    {{ $setting->currency_ar }}
                                @endif

                            </p>
                        @else
                            <p class="text-red-500 text-nowrap">{{ $item->quantity * $item->product->price }}


                                @if (app()->getLocale() == 'ar')
                                    {{ $setting->currency_ar }}
                                @else
                                    {{ $setting->currency_ar }}
                                @endif
                            </p>
                        @endif

                    </div>


                    @if ($item->product->sale_price !== null)
                        <?php $total += $item->quantity * $item->product->sale_price; ?>
                    @else
                        <?php $total += $item->quantity * $item->product->price; ?>
                    @endif
                @endforeach

                <div class="flex justify-between items-center bg-gray-200 py-3 px-2">
                    <p>{{ __('front.total') }}</p>
                    <p>{{ $total }}</p>
                </div>


                <div class="my-3">
                    <a class="bg-black text-white text-center mx-2 p-3 w-full block"
                        href="{{ route('checkout.page') }}">{{ __('front.checkout') }}</a>
                </div>
            </div>
        </div>
    </div>
     @else
        <p class="text-center p-3 bg-gray-300 my-10">{{ __('front.your_cart_is_empty') }}</p>
     @endif


  







    @include('front.inc.footer')
    @include('front.inc.bottom-navbar')
@endsection
