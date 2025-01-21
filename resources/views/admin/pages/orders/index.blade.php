@extends('admin.layout')

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('translate.orders') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>{{ __('front.name') }}</th>
                                        <th>{{ __('front.phone') }}</th>
                                        <th>{{ __('front.address') }}</th>
                                        <th>{{ __('front.payment-method') }}</th>
                                        <th>{{ __('translate.status') }}</th>
                                        <th>{{ __('front.products') }}</th>
                                        <th>{{ __('translate.actions') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>{{ $order->status }}</td>


                                            <td>

                                                @foreach ($order->products as $product_item)
                                                    <div class="d-flex align-items-start">
                                                        <div>
                                                            <img src="/uploads/{{ $product_item['product']['image'] }}"
                                                                width="50px"
                                                                alt="{{ $product_item['product']['name'] }}">
                                                        </div>
                                                        <div>
                                                            <p>{{ $product_item['product']['name'] }}</p>
                                                            <p>Quantity: {{ $product_item['quantity'] }}</p>
                                                            <div>

                                                                @foreach ($product_item['selected_variations'] as $key => $value)
                                                                    <p>{{ ucfirst($key) }}: {{ $value }}</p>
                                                                @endforeach
                                                            </div>

                                                            @php
                                                                $unitPrice =
                                                                    $product_item['product']['sale_price'] ??
                                                                    $product_item['product']['price'];
                                                                $totalPrice = $unitPrice * $product_item['quantity'];
                                                            @endphp
                                                            <p class="text-priamry">Total: {{ $totalPrice }} </p>
                                                            <hr>
                                                        </div>

                                                    </div>




                                                    <hr>
                                                @endforeach
                                            </td>

                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ __('translate.actions') }}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.show.order', $order->id) }}">{{ __('translate.show-order') }}</a>


                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.orders.completed', $order->id) }}">{{ __('translate.completed') }}</a>

                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.inc.setting')
    </div>
@endsection
