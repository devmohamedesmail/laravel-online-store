<div class="product-deatils">
    <h3 class="font-bold text-xl">{{ $product->name }}</h3>
    <h3 class="text-md mt-10 mb-5">{{ $product->description }}</h3>




    @if ($product->variations->count() > 0)
        <p class="text-primary font-bold ">
            {{ $product->variations->min('price') }}
            @if (app()->getLocale() == 'ar')
                {{ $setting->currency_ar }}
            @else
                {{ $setting->currency_en }}
            @endif

            - {{ $product->variations->max('price') }}
            @if (app()->getLocale() == 'ar')
                {{ $setting->currency_ar }}
            @else
                {{ $setting->currency_en }}
            @endif
        </p>
    @else
        <div class="mt-5">
            @if ($product->sale_price != null)
                <div class="flex items-center">
                    <p class="mx-1 text-xl text-primary font-bold">
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
    @endif

    <p id="selected-variation-price" class="text-primary font-bold ">

    </p>








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

                                            <input class="hidden switch-input variation-option"
                                                id="swatch{{ $value->id }}" type="radio"
                                                name="attributes[{{ $attribute->name }}]" value="{{ $value->value }}"
                                                data-price="{{ $product->variations->firstWhere('variation_name', $value->value)->price }}">
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
            <p class="bg-primary text-white p-2 mt-5">
                {{ $errors->first('error') }}
            </p>
        @endif














        <div class="my-10">
            <label class="text-sm mb-3">{{ __('front.quantity') }}</label>
            <div class="mt-4">
                <button class="bg-gray-200 p-2  rounded-md" id="increament_btn" type="button"><i
                        class="bi bi-plus-lg text-primary font-bold">
                    </i></button>
                <input type="text" name="quantity" id="quantity" value="1" readonly
                    class="w-10 text-center focus:outline-none fo">
                <button class="bg-gray-200 p-2 rounded-md" id="decreament_btn" type="button"> <i
                        class="bi bi-dash text-primary font-bold"></i></button>
            </div>
        </div>





        {{-- option sections --}}
        <div class="font-bold text-primary">Options</div>

        @if ($product->options && $product->options->count() > 0)
            <div>
                @foreach ($product->options as $option)
                   <div class="flex justify-between items-center my-2">
                    <div class="flex justify-between items-center">
                        <input type="checkbox" name="options[]" value="{{ $option->name }}" class="mr-2 w-7 h-7 focus:outline-none accent-primary focus:bg-primary" />
                            <label class="block my-2">{{ $option->name }} </label>
                                     
                    </div>

                    <div class="bg-primary text-white px-3 py-2 rounded-md">
                        <label class="block my-2">{{ $option->price }} </label>
                    </div>
                   </div>
                @endforeach
            </div>
            
        @else
            
        @endif




        {{-- -------------------------------------------------- --}}


        <div class="flex flex-col md:flex-row">
            <button class="flex-1 bg-black text-white rounded-md text-center mx-2 p-3 my-1"
                type="submit">{{ __('front.add-to-cart') }}</button>
            <a class="flex-1 bg-red-600 text-white text-center rounded-md mx-2 p-3 my-1"
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
                <input type="text" class="input w-full @error('phone') is-invalid @enderror" name="phone" />
                @error('name')
                    <span class="text-red-600">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="input-container my-4">
                <label class="block text-sm">{{ __('front.address') }}</label>
                <input type="text" class="input w-full @error('address') is-invalid @enderror" name="address" />
                @error('address')
                    <span class="text-red-600">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </form>
    </div>





</div>
