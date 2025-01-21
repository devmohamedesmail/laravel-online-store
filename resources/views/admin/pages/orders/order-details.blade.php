@extends('admin.layout')

@section('content')
    <div class="main-content">
        <div class="row ">
            <div class="col-12 bg-primary p-2 text-center text-white fs-2 ">
                {{ __('translate.order-details') }}
            </div>
            <div class="col-12 my-3 bg-white p-2">
                <h6 class="text-dark"> {{ __('front.name') }} : {{ $order->name }}</h2>
                    <h6 class="text-dark">{{ __('front.email') }} : {{ $order->email }}</h2>
                        <h6 class="text-dark">{{ __('front.phone') }} : {{ $order->phone }}</h2>
                            <h6 class="text-dark">{{ __('front.country') }} : {{ $order->country }}</h2>
                                <h6 class="text-dark">{{ __('front.city') }} : {{ $order->city }}</h2>
                                    <h6 class="text-dark">{{ __('front.address') }} :{{ $order->address }}</h2>
                                        <h6 class="text-dark">{{ __('front.payment_method_selected') }} :
                                            {{ $order->payment_method }}</h2>

                                            @foreach ($order->products as $product_item)
                                                <div class="d-flex align-items-start border">
                                                    <div>
                                                        <img src="/uploads/{{ $product_item['product']['image'] }}"
                                                            width="100px" alt="{{ $product_item['product']['name'] }}">
                                                    </div>
                                                    <div>

                                                        <div class="d-flex">
                                                            <p class="text-dark">{{ $product_item['product']['name'] }}</p>
                                                            <p class="text-dark mx-5">Quantity:
                                                                {{ $product_item['quantity'] }}</p>

                                                            @php
                                                                $unitPrice =
                                                                    $product_item['product']['sale_price'] ??
                                                                    $product_item['product']['price'];
                                                                $totalPrice = $unitPrice * $product_item['quantity'];
                                                            @endphp
                                                            <p class="text-dark mx-5">Total: {{ $totalPrice }} </p>
                                                        </div>






                                                        @if (count($product_item['selected_variations']) > 0)
                                                            <div class="d-flex">
                                                                @foreach ($product_item['selected_variations'] as $variation)
                                                                    <p class="bg-primary p-1 m-1">{{ $variation }}</p>
                                                                @endforeach
                                                            </div>
                                                        @endif


                                                        @if (count($product_item['selected_options']) > 0)
                                                            <div class="d-flex">
                                                                @foreach ($product_item['selected_options'] as $option)
                                                                    <p class="bg-primary p-1 m-1">{{ $option }}</p>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                       
                                                    </div>

                                                </div>
                                            @endforeach


             {{-- Order Actions start --}}
            <div class="my-5">
                <a href="" class="btn btn-success"> {{ __('translate.print') }} </a>
                <a href="" class="btn btn-danger"> {{ __('translate.delete') }} </a>
                <a href="" class="btn btn-primary"> {{ __('translate.completed') }} </a>
            </div>  
             {{-- Order Actions end --}}                              
            </div>
        </div>
        @include('admin.inc.setting')
    </div>
@endsection
