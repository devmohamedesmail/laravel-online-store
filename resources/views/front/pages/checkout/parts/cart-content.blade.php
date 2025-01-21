@if ($cartItems->count() > 0)
<div class="second-column">
    <div>
        <h5 class="text-center bg-gray-100 p-3">{{ __('front.your_order') }}</h5>
        @if ($cartItems->count() > 0)
            @foreach ($cartItems as $item)
                <div class="flex my-2 border border-gray-300 h-24 ">
                    <div class="w-24 h-24">
                        <img src="{{ asset('/uploads/' . $item->product->image) }}"
                            class="w-full h-full" />
                    </div>
                    <div class="mx-2 pt-3">
                        <p class="text-xs font-bold">{{ $item->product->name }} </p>
                        <div>

                            @if ($item->product->sale_price !== null)
                                <div class="flex items-center">
                                    <p class="text-sm mr-2 text-primary">
                                        {{ $item->product->sale_price }}
                                        @if (app()->getLocale() == 'ar')
                                            {{ $setting->currency_ar }}
                                        @else
                                            {{ $setting->currency_en }}
                                        @endif
                                    </p>
                                    <p class="line-through text-sm mr-2 text-gray-500">
                                        {{ $item->product->price }} @if (app()->getLocale() == 'ar')
                                            {{ $setting->currency_ar }}
                                        @else
                                            {{ $setting->currency_en }}
                                        @endif
                                    </p>
                                </div>
                            @else
                                <p class="text-sm text-primary">
                                    {{ $item->product->price }} @if (app()->getLocale() == 'ar')
                                        {{ $setting->currency_ar }}
                                    @else
                                        {{ $setting->currency_en }}
                                    @endif
                                </p>
                            @endif


                        </div>
                        <div class="flex">
                            <div class="flex  items-center justify-between">
                                <p>{{ __('front.quantity') }} </p>
                                <p class="mx-2 bg-primary text-white py-1 px-3 rounded-md">
                                    {{ $item->quantity }}</p>
                            </div>
    
                            <div class="flex items-center justify-between">
                                @if (is_array($item->selected_options) && count($item->selected_options) > 0)
                                    @foreach ($item->selected_options as $option)
                                        <p class="bg-primary mx-1 text-white text-xs rounded-md p-1">{{ $option }}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center py-3 text-red-600">{{ __('front.your_cart_is_empty') }}</p>
        @endif
    </div>




    <div class="mt-5">
        <h2 class="text-center bg-gray-100 p-3">
            {{ __('front.payment_method') }}
        </h2>
        @if ($payment_methods->count() > 0)
            <div class="flex flex-col my-3">
                @foreach ($payment_methods as $method)
                    <label for="{{ $method->id }}"
                        class="flex items-center justify-between border border-gray-300 py-4 px-2 mb-2">
                        <span>

                            @if (app()->getLocale() == 'ar')
                                {{ $method->type_ar }}
                            @else
                                {{ $method->type_en }}
                            @endif


                        </span>
                        <input type="radio" id="{{ $method->id }}" name="payment_method"
                            value="{{ $method->id }}"
                            class="payment-method-radio @error('payment_method') is-invalid @enderror"
                            data-type="{{ $method->id }}">
                    </label>
                @endforeach
                @error('payment_method')
                    <span class="text-red-600">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        @else
            <p class="bg-gray-300 p-4">No payment method</p>
        @endif
    </div>


    <div id="card-element" class="hidden my-5 border border-gray-300 py-4 px-2"></div>






    <input type="hidden" name="cartItems" value="{{ json_encode($cartItems) }}">
    <input type="hidden" name="stripeToken" id="stripeToken" value="">
    <button class="w-full bg-black py-3 text-white" type="button"
        onclick="createToken()">{{ __('front.order-now') }}</button>



</div>
@else
<div>
    <p class="text-center py-3 text-red-600">{{ __('front.your_cart_is_empty') }}</p>
</div>
@endif
