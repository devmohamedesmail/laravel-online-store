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





    <div class="container m-auto px-2 my-5">
        <h3 class="text-center text-2xl bg-priamry p-2">{{ __('front.checkout') }}</h3>

        <form action="{{ route('add.order') }}" method="post" id="checkout-form">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @include('front.pages.checkout.parts.billing-info')

                <div class="second-column">
                    <div>
                        <h5 class="text-center bg-gray-100 p-3">{{ __('front.your_order') }}</h5>
                        @if ($cartItems->count() > 0)
                            @foreach ($cartItems as $item)
                                <div class="flex my-2 border border-gray-300 h-24">
                                    <div class="w-40">
                                        <img src="{{ asset('/uploads/' . $item->product->image) }}" class="w-full h-full" />
                                    </div>
                                    <div class="mx-2">
                                        <p class="text-xs">{{ $item->product->name }} </p>
                                        <div>

                                            @if ($item->product->sale_price !== null)
                                                <div class="flex items-center">
                                                    <p class="text-sm mr-2 text-primary">{{ $item->product->sale_price }}
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
                                        <p class="">
                                            {{ __('front.quantity') }} {{ $item->quantity }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>{{ __('front.your_cart_is_empty') }}</p>
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
                                        <span>{{ $method->type_en }}</span>
                                        <input type="radio" id="{{ $method->id }}" name="payment_method"
                                            value="{{ $method->id }}" class="payment-method-radio"
                                            data-type="{{ $method->type_en }}">
                                    </label>
                                @endforeach
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






            </div>

        </form>
    </div>



    @include('front.inc.footer')
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        var stripe = Stripe(
            'pk_test_51QYXhyQCzh9jGNXoJVPGX8puPrj58gqc5DK7I3bFiyeGlvpr03877CPR2fX0u6aK5BmTtLkrirDovkI7Ms3ihYvq00ZXcVGx6w'
        );
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        function createToken() {
            stripe.createToken(cardElement).then(function(result) {
                if (result.token) {
                    document.getElementById('stripeToken').value = result.token.id;
                    document.getElementById('checkout-form').submit();
                } else {
                    document.getElementById('checkout-form').submit();
                }

            });
        }















        // function createToken() {
        //     paymentInputs = document.querySelectorAll('.payment-method-radio');
        //     let selectedValue = null;

        //     paymentInputs.forEach((input) => {
        //         if (input.checked) {
        //             selectedValue = input.value;
        //         }
        //     });

        //     if (selectedValue && selectedValue === '2') {




        //         console.log('you are using stripe');
        //         var stripe = Stripe(
        //             'pk_test_51QYXhyQCzh9jGNXoJVPGX8puPrj58gqc5DK7I3bFiyeGlvpr03877CPR2fX0u6aK5BmTtLkrirDovkI7Ms3ihYvq00ZXcVGx6w'
        //         );
        //         var elements = stripe.elements();
        //         var cardElement = elements.create('card');
        //         cardElement.mount('#card-element');
        //         stripe.createToken(cardElement).then(function(result) {
        //             if (result.token) {
        //                 document.getElementById('stripeToken').value = result.token.id;
        //                 document.getElementById('checkout-form').submit();
        //             }

        //         });
        //     } else {
        //         document.getElementById('checkout-form').submit();
        //     }
        // }
    </script>


@endsection
