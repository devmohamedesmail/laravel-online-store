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

    @if (session('error'))
        <script>
            iziToast.success({
                title: 'Error',
                message: '{{ session('error') }}',
                position: 'topRight',
                timeout: 3000
            });
        </script>
    @endif






    <div class="conatiner m-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 m-auto bg-priamry p-2 gap-5">
            <div class="images-gallery">


                <div class="swiper mySwiper2">
                    <div class="swiper-wrapper ">
                        @if ($product->gallery != null)
                            @foreach ($product->gallery as $img)
                                <div class="swiper-slide flex justify-center items-center" style="height: 400px !important">
                                    <img src="{{ asset('/uploads/' . $img) }}"  />
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide">
                                <img src="{{ asset('/uploads/' . $product->image) }}" width="100%" />
                            </div>
                        @endif


                    </div>

                </div>
                <div thumbsSlider="" class="swiper mySwiper">
                    <div class="swiper-wrapper  flex justify-center items-center">




                        @if ($product->gallery != null)
                            @foreach ($product->gallery as $img)
                                <div class="swiper-slide border border-gray-300 w-40 overflow-hidden" style="height: 100px !important; width: 40px !important">
                                    <img src="{{ asset('/uploads/' . $img) }}" class="w-full h-full" />
                                </div>
                            @endforeach
                        @else
                        @endif



                    </div>
                </div>
            </div>

            <div class="product-deatils">
                <h3 class="font-bold text-xl">{{ $product->name }}</h3>
                <h3 class="text-xl">{{ $product->description }}</h3>

                <div class="mt-5">
                    @if ($product->sale_price != null)
                        <div class="flex items-center">
                            <p class="mx-1 text-xl">
                                {{ $product->sale_price }}

                                @if (app()->getLocale() == 'ar')
                                    {{ $setting->currency_ar }}
                                @else
                                    {{ $setting->currency_ar }}
                                @endif
                            </p>
                            <p class="mx-2 line-through text-gray-500 ">
                                {{ $product->price }}
                                @if (app()->getLocale() == 'ar')
                                    {{ $setting->currency_ar }}
                                @else
                                    {{ $setting->currency_ar }}
                                @endif
                            </p>
                        </div>
                    @else
                        <p class="text-primary font-bold">{{ $product->price }}
                            @if (app()->getLocale() == 'ar')
                                {{ $setting->currency_ar }}
                            @else
                                {{ $setting->currency_ar }}
                            @endif
                        </p>
                    @endif
                </div>




                <div class="flex justify-evenly my-4">
                    <div
                        class="flex-1 border border-gray-300 p-2 mr-2 rounded-md flex flex-col justify-center items-center">
                        <i class="bi bi-truck text-2xl"></i>
                        <p class="text-sm">{{ __('front.free-delivery') }}</p>
                    </div>

                    <div
                        class="flex-1 border border-gray-300 p-2 mr-2 rounded-md flex flex-col justify-center items-center">

                        <i class="bi bi-arrow-clockwise text-2xl"></i>
                        <p class="text-sm">{{ __('front.return') }}</p>
                    </div>

                    <div
                        class="flex-1 border border-gray-300 p-2 mr-2 rounded-md flex flex-col justify-center items-center">

                        <i class="bi bi-stripe text-2xl"></i>
                        <p class="text-sm">{{ __('front.safe-payment') }}</p>
                    </div>
                </div>



                <form method="post" action="{{ route('add.cart', [$product->id, $product->name]) }}"
                    enctype="multipart/form-data">
                    @csrf



                    @if ($product->attributes && $product->attributes->count() > 0)
                        <div>
                            @foreach ($product->attributes as $attribute)
                                <div data-option-index="1">
                                    <div class="product-form__item">
                                        <label class="block my-2">{{ $attribute->name }}</label>

                                        <div class="flex flex-wrap">
                                            @if ($attribute->values && $attribute->values->count() > 0)
                                                @foreach ($attribute->values as $value)
                                                    <div class="flex mr-2">
                                                        <!-- Ensure label is after input to target it with the + selector -->
                                                        <input class="hidden switch-input" id="swatch{{ $value->id }}"
                                                            type="radio" name="attributes[{{ $attribute->name }}]"
                                                            value="{{ $value->value }}">
                                                        <label style="width: fit-content;" for="swatch{{ $value->id }}"
                                                            title="{{ $value->value }}"
                                                            class="bg-gray-100 px-3 rounded-md py-1 switch-label text-sm">
                                                            {{ $value->value }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                    @endif



                    @if ($errors->has('error'))
                        <div class="alert alert-danger">
                            {{ $errors->first('error') }}
                        </div>
                    @endif














                    <div class="my-10">
                        <label class="text-sm mb-3">{{ __('front.quantity') }}</label>
                        <div class="mt-4">
                            <button class="bg-gray-200 p-2 rounded-sm" id="increament_btn" type="button"><i
                                    class="bi bi-plus-lg">
                                </i></button>
                            <input type="text" name="quantity" id="quantity" value="1" readonly
                                class="w-10 text-center focus:outline-none fo">
                            <button class="bg-gray-200 p-2 rounded-sm" id="decreament_btn" type="button"> <i
                                    class="bi bi-dash"></i></button>
                        </div>
                    </div>


                    <div class="flex">
                        <button class="flex-1 bg-black text-white text-center mx-2 p-3"
                            type="submit">{{ __('front.add-to-cart') }}</button>
                        <a class="flex-1 bg-red-600 text-white text-center mx-2 p-3"
                            href="{{ route('checkout.page', $product->id) }}">{{ __('front.checkout') }}</a>
                    </div>




                </form>

                <div class="my-4">
                    <h3 class="text-center text-2xl">{{ __('front.fast-order') }}</h3>
                    <form action="{{ route('add.order') }}" method="POST">
                        @csrf
                        <div class="input-container my-4">
                            <label class="block text-sm">{{ __('front.name') }}</label>
                            <input type="text" class="input w-full @error('name') is-invalid @enderror" name="name" />
                            @error('name')
                                <span class="text-red-600">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="input-container my-4">
                            <label class="block text-sm">{{ __('front.phone') }}</label>
                            <input type="text" class="input w-full @error('phone') is-invalid @enderror"
                                name="phone" />
                            @error('name')
                                <span class="text-red-600">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="input-container my-4">
                            <label class="block text-sm">{{ __('front.address') }}</label>
                            <input type="text" class="input w-full @error('address') is-invalid @enderror"
                                name="address" />
                            @error('address')
                                <span class="text-red-600">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>





            </div>
        </div>
    </div>
    <div class="container m-auto">
        <div class="text-center">
            {!! $product->long_description !!}
        </div>
    </div>
    @include('front.inc.footer')
    @include('front.inc.bottom-navbar')

@endsection
