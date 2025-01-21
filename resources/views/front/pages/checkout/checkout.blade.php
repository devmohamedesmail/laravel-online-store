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
        <h3 class="text-center text-2xl bg-gray-200 py-4">{{ __('front.checkout') }}</h3>

        <form action="{{ route('add.order') }}" method="post" id="checkout-form">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 my-10">
                @include('front.pages.checkout.parts.billing-info')
                @include('front.pages.checkout.parts.cart-content')
            </div>
        </form>
    </div>

    @include('front.inc.footer')
    @include('front.inc.bottom-navbar')



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
