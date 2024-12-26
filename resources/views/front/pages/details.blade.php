@extends('front.layout')

@section('content')
    @include('front.inc.search')

    @include('front.inc.top-header')

    @include('front.inc.header')

    @include('front.inc.mobile-nav')


    <!--Body Content-->
    <div id="page-content">

        <div id="MainContent" class="main-content mt-5" role="main">
            <!--Breadcrumb-->
            <div class="bredcrumbWrap">
                <div class="container breadcrumbs">

                </div>
            </div>
            <!--End Breadcrumb-->

            <div id="ProductSection-product-template" class="product-template__container prstyle1 container">
                <!--product-single-->
                <div class="product-single">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="product-details-img">

                                <div class="product-thumb">
                                    <div id="gallery" class="product-dec-slider-2 product-tab-left">
                                        @if ($product->gallery != null)
                                            @foreach ($product->gallery as $img)
                                                <a data-image="{{ asset('/uploads/'. $img) }}"
                                                    data-zoom-image="{{ asset('/uploads/'. $img) }}"
                                                    class="slick-slide slick-cloned" data-slick-index="-4"
                                                    aria-hidden="true" tabindex="-1">
                                                    <img class="blur-up lazyload"
                                                        src="{{ asset('/uploads/'. $img) }}"
                                                        alt="{{ $product->name }}" />
                                                </a>
                                            @endforeach
                                        @else
                                        @endif
                                    </div>
                                </div>

                               
                                <div class="zoompro-wrap product-zoom-right pl-20">
                                    <div class="zoompro-span">
                                        <img class="blur-up lazyload zoompro"
                                            data-zoom-image="{{ asset('uploads'. $product->image) }}"
                                            alt="{{ $product->name }}" src="{{ asset('/uploads/'. $product->image) }}"
                                            width="100%" />
                                    </div>


                                </div>



                            </div>
                        </div>



                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                            <div class="product-single__meta">
                                <h1 class="product-single__title">{{ $product->name }}</h1>

                                <p class="product-single__price product-single__price-product-template">

                                    @if ($product->sale_price)
                                        <span id="ComparePrice-product-template"><span class="money">{{ $product->price }}

                                                @if (app()->getLocale() == 'ar')
                                                    {{ $setting->currency_ar }}
                                                @else
                                                    {{ $setting->currency_en }}
                                                @endif

                                            </span></span>
                                        <span
                                            class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                            <span id="ProductPrice-product-template"><span
                                                    class="money">{{ $product->sale_price }}

                                                    @if (app()->getLocale() == 'ar')
                                                        {{ $setting->currency_ar }}
                                                    @else
                                                        {{ $setting->currency_en }}
                                                    @endif
                                                </span></span>
                                        </span>
                                    @else
                                        <span
                                            class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                            <span id="ProductPrice-product-template"><span
                                                    class="money">{{ $product->price }}

                                                    @if (app()->getLocale() == 'ar')
                                                        {{ $setting->currency_ar }}
                                                    @else
                                                        {{ $setting->currency_en }}
                                                    @endif

                                                </span></span>
                                        </span>
                                    @endif
                                </p>

                            </div>

                            <div class="product-single__description rte">
                                {{ $product->description }}
                            </div>


                            <form method="post" action="{{ route('add.cart', [$product->id, $product->name]) }}"
                                id="product_form_10508262282" accept-charset="UTF-8"
                                class="product-form product-form-product-template hidedropdown"
                                enctype="multipart/form-data">
                                @csrf



                                @if ($product->attributes && $product->attributes->count() > 0)
                                    <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                        @foreach ($product->attributes as $attribute)
                                            <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                                <div class="product-form__item">
                                                    <label class="header">{{ $attribute->name }}</label>

                                                    @if ($attribute->values && $attribute->values->count() > 0)
                                                        @foreach ($attribute->values as $value)
                                                            <div data-value="XS" class="swatch-element xs available">
                                                                <input class="swatchInput" id="swatch{{ $value->id }}"
                                                                    type="radio"
                                                                    name="attributes[{{ $attribute->name }}]"
                                                                    value="{{ $value->value }}">
                                                                <label class="swatchLbl large rectangle" style="width: fit-content;"
                                                                    for="swatch{{ $value->id }}"
                                                                    title="{{ $value->value }}">{{ $value->value }}</label>
                                                            </div>
                                                        @endforeach
                                                    @endif
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







                                <!-- Product Action -->
                                <div class="product-action clearfix">
                                    <div class="product-form__item--quantity">
                                        <div class="wrapQtyBtn">
                                            <div class="qtyField">
                                                <a class="qtyBtn minus" href="javascript:void(0);"><i
                                                        class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                                <input type="text" id="Quantity" name="quantity" value="1"
                                                    class="product-form__input qty">
                                                <a class="qtyBtn plus" href="javascript:void(0);"><i
                                                        class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-form__item--submit">
                                        <button type="submit" name="add" class="btn product-form__cart-submit">
                                            <span>
                                                {{ __('front.add-to-cart') }}
                                            </span>
                                        </button>
                                    </div>
                                    <div class="shopify-payment-button" data-shopify="payment-button">
                                        <a href="{{ route('checkout.page', $product->id) }}" type="button"
                                            class="shopify-payment-button__button shopify-payment-button__button--unbranded">
                                            {{ __('front.buy-now') }}
                                        </a>
                                    </div>


                                    
                                </div>


                                <div class="shopify-payment-button my-3 w-100" style="margin-top: 10px" data-shopify="payment-button">
                                    <a href="{{ route('checkout.page') }}" type="button"
                                        class="shopify-payment-button__button shopify-payment-button__button--unbranded">
                                        {{ __('front.checkout') }}
                                    </a>
                                </div>
                                <!-- End Product Action -->
                            </form>








                            <div class="display-table shareRow">
                                <div class="display-table-cell medium-up--one-third">
                                    <div class="wishlist-btn">
                                        <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist"><i
                                                class="icon anm anm-heart-l" aria-hidden="true"></i> <span>
                                                {{ __('front.add-to-wishlist') }}
                                            </span></a>
                                    </div>
                                </div>
                                <div class="display-table-cell text-right">
                                    <div class="social-sharing">
                                        <a target="_blank" href="#"
                                            class="btn btn--small btn--secondary btn--share share-facebook"
                                            title="Share on Facebook">
                                            <i class="fa fa-facebook-square" aria-hidden="true"></i> <span
                                                class="share-title" aria-hidden="true">{{ __('front.share') }}</span>
                                        </a>
                                        <a target="_blank" href="#"
                                            class="btn btn--small btn--secondary btn--share share-twitter"
                                            title="Tweet on Twitter">
                                            <i class="fa fa-twitter" aria-hidden="true"></i> <span class="share-title"
                                                aria-hidden="true">Tweet</span>
                                        </a>
                                        <a href="#" title="Share on google+"
                                            class="btn btn--small btn--secondary btn--share">
                                            <i class="fa fa-google-plus" aria-hidden="true"></i> <span
                                                class="share-title" aria-hidden="true">Google+</span>
                                        </a>
                                        <a target="_blank" href="#"
                                            class="btn btn--small btn--secondary btn--share share-pinterest"
                                            title="Pin on Pinterest">
                                            <i class="fa fa-pinterest" aria-hidden="true"></i> <span class="share-title"
                                                aria-hidden="true">Pin it</span>
                                        </a>
                                        <a href="#" class="btn btn--small btn--secondary btn--share share-pinterest"
                                            title="Share by Email" target="_blank">
                                            <i class="fa fa-envelope" aria-hidden="true"></i> <span class="share-title"
                                                aria-hidden="true">Email</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End-product-single-->


















                <!--Product Tabs-->
                <div class="tabs-listing">
                    <ul class="product-tabs d-flex justify-content-center list-unstyled">
                        <li rel="tab1"><a class="tablink mx-3 bg-dark p-3 text-white"> {{ __('front.product-details') }} </a></li>
                        <li rel="tab2"><a class="tablink mx-3 bg-dark p-3 text-white"> {{ __('front.product-reviews') }} </a></li>

                    </ul>
                    <div class="tab-container">

                        <div id="tab1" class="tab-content">
                            <div class="product-description rte">
                                {!! $product->long_description !!}
                            </div>
                        </div>


                        <div id="tab2" class="tab-content">
                            <div id="shopify-product-reviews">
                                <div class="spr-container">
                                    <div class="spr-header clearfix">
                                        <div class="spr-summary">
                                            <span class="product-review"><a class="reviewLink"><i
                                                        class="font-13 fa fa-star"></i><i
                                                        class="font-13 fa fa-star"></i><i
                                                        class="font-13 fa fa-star"></i><i
                                                        class="font-13 fa fa-star-o"></i><i
                                                        class="font-13 fa fa-star-o"></i> </a><span
                                                    class="spr-summary-actions-togglereviews">Based on 6
                                                    reviews456</span></span>
                                            <span class="spr-summary-actions">
                                                <a href="#" class="spr-summary-actions-newreview btn">Write a
                                                    review</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="spr-content">
                                        <div class="spr-form clearfix">
                                            <form method="post" action="#" id="new-review-form"
                                                class="new-review-form">
                                                <h3 class="spr-form-title">Write a review</h3>
                                                <fieldset class="spr-form-contact">
                                                    <div class="spr-form-contact-name">
                                                        <label class="spr-form-label"
                                                            for="review_author_10508262282">Name</label>
                                                        <input class="spr-form-input spr-form-input-text "
                                                            id="review_author_10508262282" type="text"
                                                            name="review[author]" value=""
                                                            placeholder="Enter your name">
                                                    </div>
                                                    <div class="spr-form-contact-email">
                                                        <label class="spr-form-label"
                                                            for="review_email_10508262282">Email</label>
                                                        <input class="spr-form-input spr-form-input-email "
                                                            id="review_email_10508262282" type="email"
                                                            name="review[email]" value=""
                                                            placeholder="john.smith@example.com">
                                                    </div>
                                                </fieldset>
                                                <fieldset class="spr-form-review">
                                                    <div class="spr-form-review-rating">
                                                        <label class="spr-form-label">Rating</label>
                                                        <div class="spr-form-input spr-starrating">
                                                            <div class="product-review"><a class="reviewLink"
                                                                    href="#"><i class="fa fa-star-o"></i><i
                                                                        class="font-13 fa fa-star-o"></i><i
                                                                        class="font-13 fa fa-star-o"></i><i
                                                                        class="font-13 fa fa-star-o"></i><i
                                                                        class="font-13 fa fa-star-o"></i></a></div>
                                                        </div>
                                                    </div>

                                                    <div class="spr-form-review-title">
                                                        <label class="spr-form-label"
                                                            for="review_title_10508262282">Review Title</label>
                                                        <input class="spr-form-input spr-form-input-text "
                                                            id="review_title_10508262282" type="text"
                                                            name="review[title]" value=""
                                                            placeholder="Give your review a title">
                                                    </div>

                                                    <div class="spr-form-review-body">
                                                        <label class="spr-form-label" for="review_body_10508262282">Body
                                                            of Review <span
                                                                class="spr-form-review-body-charactersremaining">(1500)</span></label>
                                                        <div class="spr-form-input">
                                                            <textarea class="spr-form-input spr-form-input-textarea " id="review_body_10508262282" data-product-id="10508262282"
                                                                name="review[body]" rows="10" placeholder="Write your comments here"></textarea>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="spr-form-actions">
                                                    <input type="submit"
                                                        class="spr-button spr-button-primary button button-primary btn btn-primary"
                                                        value="Submit Review">
                                                </fieldset>
                                            </form>
                                        </div>
                                        <div class="spr-reviews">
                                            <div class="spr-review">
                                                <div class="spr-review-header">
                                                    <span
                                                        class="product-review spr-starratings spr-review-header-starratings"><span
                                                            class="reviewLink"><i class="fa fa-star"></i><i
                                                                class="font-13 fa fa-star"></i><i
                                                                class="font-13 fa fa-star"></i><i
                                                                class="font-13 fa fa-star"></i><i
                                                                class="font-13 fa fa-star"></i></span></span>
                                                    <h3 class="spr-review-header-title">Lorem ipsum dolor sit amet</h3>
                                                    <span class="spr-review-header-byline"><strong>dsacc</strong> on
                                                        <strong>Apr 09, 2019</strong></span>
                                                </div>
                                                <div class="spr-review-content">
                                                    <p class="spr-review-content-body">Lorem ipsum dolor sit amet,
                                                        consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                        consequat.</p>
                                                </div>
                                            </div>
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                <!--End Product Tabs-->

                <!--Related Product Slider-->
                <div class="related-product grid-products">
                    <header class="section-header">
                        <h2 class="section-header__title text-center h2"><span>
                                {{ __('front.related_products') }}
                            </span></h2>

                    </header>
                    <div class="productPageSlider">


                        @foreach ($related_products as $item)
                            <div class="col-12 item">

                                <div class="product-image">

                                    <a href="{{ route('product.details', $item->id) }}">

                                        <img class="primary blur-up lazyload"
                                            data-src="{{ asset('uploads/' . $item->image) }}"
                                            src="{{ asset('uploads/' . $item->image) }}" alt="{{ $item->name }}"
                                            title="product">

                                        <img class="hover blur-up lazyload"
                                            data-src="{{ asset('uploads/' . $item->image) }}"
                                            src="{{ asset('uploads/' . $item->image) }}" alt="{{ $item->name }}"
                                            title="product">


                                    </a>
                                    <!-- end product image -->

                                    <!-- Start product button -->
                                    <form class="variants add" action="#"
                                        onclick="window.location.href='cart.html'"method="post">
                                        <button class="btn btn-addto-cart" type="button" tabindex="0">Select
                                            Options</button>
                                    </form>
                                    <div class="button-set">
                                        <a href="#" title="Quick View" class="quick-view" tabindex="0">
                                            <i class="icon anm anm-search-plus-r"></i>
                                        </a>
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                <i class="icon anm anm-heart-l"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- end product button -->
                                </div>
                                <!-- end product image -->
                                <!--start product details -->
                                <div class="product-details text-center">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="{{ route('product.details', $item->id) }}">{{ $item->name }}</a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->

                                    @if ($item->sale_price)
                                        <div class="product-price">
                                            <span class="old-price">{{ $item->price }}
                                                @if (app()->getLocale() == 'ar')
                                                    {{ $setting->currency_ar }}
                                                @else
                                                    {{ $setting->currency_en }}
                                                @endif
                                            </span>
                                            <span class="price">{{ $item->sale_price }}

                                                @if (app()->getLocale() == 'ar')
                                                    {{ $setting->currency_ar }}
                                                @else
                                                    {{ $setting->currency_en }}
                                                @endif

                                            </span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span class="old-price"></span>
                                            <span class="price">
                                                {{ $product->price }}

                                                @if (app()->getLocale() == 'ar')
                                                    {{ $setting->currency_ar }}
                                                @else
                                                    {{ $setting->currency_en }}
                                                @endif

                                            </span>
                                        </div>
                                    @endif



                                </div>
                                <!-- End product details -->
                            </div>
                        @endforeach




                    </div>
                </div>

            </div>

        </div>

    </div>


    <!--Footer-->
    @include('front.inc.footer')

    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
@endsection
