@extends('admin.layout')

@section('content')
    <div class="main-content">



        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>{{ __('translate.name') }}</th>
                                                <th>{{ __('translate.email') }}</th>
                                                <th>{{ __('products.image') }}</th>
                                                <th>{{ __('products.price') }}</th>
                                                <th>{{ __('products.sale-price') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $item)
                                                <tr>
                                                    <td>
                                                        @if ($item && $item->user)
                                                            {{ $item->user->name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item && $item->user)
                                                            {{ $item->user->email }}
                                                        @endif
                                                    </td>
                                                    <td><img src="/uploads/{{ $item->product->image }}" width="50px">
                                                    </td>
                                                    <td>{{ $item->product->price }}</td>
                                                    <td>{{ $item->product->sale_price }}</td>



                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('admin.inc.setting')
    </div>
@endsection
