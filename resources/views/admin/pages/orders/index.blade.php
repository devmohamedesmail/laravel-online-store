@extends('admin.layout')

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Export Table</h4>
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
                                        <th>{{ __('front.products') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            {{-- <td>

                                                @foreach (collect($order->products) as $product_item)
                                                    
                                                    <div>
                                                        @foreach ($product_item['product'] as $item)
                                                          
                                                        @endforeach
                                                    </div>
                                                    <div class="d-flex">
                                                        <p>{{ $product_item['quantity'] }}</p>
                                                        <ul>
                                                            @foreach ($product_item['selected_variations'] as $key => $value)
                                                                <li>{{ ucfirst($key) }}: {{ $value }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                   
                                                    <hr>
                                                @endforeach
                                            </td> --}}

                                            <td>
                                                {{-- Loop through each product in the order --}}
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
