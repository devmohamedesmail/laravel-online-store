<div class="product-rows section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="section-header text-center">
                    <h2 class="h2">{{ __('front.new_arrivals') }}</h2>
                   
                </div>
            </div>
        </div>
        <div class="grid-products">
            <div class="row">
                @foreach ($all_products as $product)
                    <div class="col-6 col-sm-2 col-md-3 col-lg-3 item">

                        <div class="product-image">

                            <a href="{{ route('product.details', $product->id) }}" class="grid-view-item__link">

                                <img class="primary blur-up lazyload" data-src="{{ asset('/uploads/' . $product->image) }}"
                                    src="{{ asset('/uploads/' . $product->image) }}" alt="{{ $product->name }}"
                                    title="{{ $product->name }}">





                                <!-- Hover image -->
                                <img class="hover blur-up lazyload" data-src="{{ asset('/uploads/' . $product->image) }}"
                                    src="{{ asset('/uploads/' . $product->image) }}" alt="{{ $product->name }}"
                                    title="{{ $product->name }}">








                                <!-- product label -->
                                <div class="product-labels rounded">
                                    <span class="lbl on-sale">
                                        @if ($product->featured)
                                          {{ __('front.featured') }}
                                        @endif
                                    </span>
                                   
                                </div>
                                <!-- End product label -->
                            </a>
                            <!-- end product image -->

                           

                            <!-- Start product button -->
                            <form class="variants add" action="#"
                                onclick="window.location.href='cart.html'"method="post">
                                <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                            </form>




                            <div class="button-set">

                                <div class="wishlist-btn">
                                    <a class="wishlist add-to-wishlist" href="wishlist.html">
                                        <i class="icon anm anm-heart-l"></i>
                                    </a>
                                </div>

                            </div>

                        </div>






                        <div class="product-details text-center">

                            <div class="product-name">
                                <a href="product-layout-1.html">{{ $product->name }}</a>
                            </div>



                            @if ($product->sale_price)
                                <div class="product-price">
                                    <span class="old-price">{{ $product->price }}
                                        @if (app()->getLocale() == 'ar')
                                            {{ $setting->currency_ar }}
                                        @else
                                            {{ $setting->currency_en }}
                                        @endif
                                    </span>
                                    <span class="price">{{ $product->sale_price }}

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

                    </div>
                @endforeach



            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <a href="shop-left-sidebar.html" class="btn">View all</a>
                </div>
            </div>
        </div>
    </div>
</div>
