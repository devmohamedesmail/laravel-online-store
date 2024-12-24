@extends('front.layout')

@section('content')
    @include('front.inc.search')

    @include('front.inc.top-header')

    @include('front.inc.header')

    @include('front.inc.mobile-nav')


    <!--Body Content-->
    <div id="page-content mt-4">
        <div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper">
                    <h1 class="page-width">Checkout</h1>
                </div>
            </div>
        </div>
        <!--End Page Title-->

        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                    <div class="customer-box returning-customer">
                        <h3><i class="icon anm anm-user-al"></i> Returning customer? <a href="#customer-login" id="customer"
                                class="text-white text-decoration-underline" data-toggle="collapse">Click here to login</a>
                        </h3>
                        <div id="customer-login" class="collapse customer-content">
                            <div class="customer-info">
                                <p class="coupon-text">If you have shopped with us before, please enter your details in the
                                    boxes below. If you are a new customer, please proceed to the Billing &amp; Shipping
                                    section.</p>
                                <form>
                                    <div class="row">
                                        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="exampleInputEmail1">Email address <span
                                                    class="required-f">*</span></label>
                                            <input type="email" class="no-margin" id="exampleInputEmail1">
                                        </div>
                                        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <label for="exampleInputPassword1">Password <span
                                                    class="required-f">*</span></label>
                                            <input type="password" id="exampleInputPassword1">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-check width-100 margin-20px-bottom">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" value=""> Remember
                                                    me!
                                                </label>
                                                <a href="#" class="float-right">Forgot your password?</a>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                    <div class="customer-box customer-coupon">
                        <h3 class="font-15 xs-font-13"><i class="icon anm anm-gift-l"></i> Have a coupon? <a
                                href="#have-coupon" class="text-white text-decoration-underline"
                                data-toggle="collapse">Click here to enter your code</a></h3>
                        <div id="have-coupon" class="collapse coupon-checkout-content">
                            <div class="discount-coupon">
                                <div id="coupon" class="coupon-dec tab-pane active">
                                    <p class="margin-10px-bottom">Enter your coupon code if you have one.</p>
                                    <label class="required get" for="coupon-code"><span class="required-f">*</span>
                                        Coupon</label>
                                    <input id="coupon-code" required="" type="text" class="mb-3">
                                    <button class="coupon-btn btn" type="submit">Apply Coupon</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row billing-fields">
                {{-- @include('front.pages.checkout.parts.billing-info') --}}

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="your-order-payment">
                        <div class="your-order">
                            <h2 class="order-title mb-4">Your Order</h2>


                        </div>


                        <section>
                            <div class="product">
                                <img src="https://i.imgur.com/EHyR2nP.png" alt="The cover of Stubborn Attachments" />
                                <div class="description">
                                    <h3>Stubborn Attachments</h3>
                                    <h5>$20.00</h5>
                                </div>
                            </div>
                            <form action="{{ route('checkout.session.create') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary" id="checkout-button">Checkout</button>
                            </form>
                        </section>

                        <hr />

                        <div class="your-payment">
                            <h2 class="payment-title mb-3">payment method</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

    @include('front.inc.footer')

    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
@endsection
