
<div class="container m-auto">
    <h5 class="text-center text-xl my-5">{{ __('front.new_arrivals') }}</h5>




    <div class="grid grid-cols-2 md:grid-cols-7 lg:grid-cols-7 gap-2">

        @foreach ($all_products as $product)
            <div class="product-card">

                <div class="relative">
                    <a href="{{ route('product.details', $product->id) }}" class="block  w-full h-80">
                        <img src="/uploads/{{ $product->image }}" width="100%" class="w-full h-full" alt="{{ $product->name }}">


                    </a>
                    <a href="{{ route('product.details', $product->id) }}"
                        class="absolute bottom-0 left-0 right-0 text-center py-2 bg-black text-white no-underline">
                        <i class="bi bi-bag"></i>
                      <span class="mx-1 text-sm">  {{ __('front.add-to-cart') }}</a></span>
                </div>

                <p class="text-center text-sm mt-2"> 
                    {{ \Illuminate\Support\Str::words($product->name, 5, '...') }}
                </p>

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
                        <p class="text-center font-bold mt-2 text-primary"> {{ $product->price }}

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
