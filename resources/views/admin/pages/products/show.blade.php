@extends('admin.layout')

@section('content')
    <div class="main-content">

        <h6 class="row bg-white text-dark p-2">{{ __('translate.products') }} - {{ $products->count() }}</h6>
        <div class="row bg-white">
            <div class="col-12">
                <div class="bg-white p-2">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('products.product-name') }}</th>
                                    <th>{{ __('products.category-name') }}</th>
                                    <th>{{ __('products.image') }}</th>
                                    <th>{{ __('products.price') }}</th>
                                    <th>{{ __('products.variation') }}</th>
                                    <th>{{ __('products.options') }}</th>
                                    <th><i class="fas fa-ellipsis-h"></i></th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>
                                            <img src="/uploads/{{ $product->image }}" width="100" height="100"
                                                alt="{{ $product->name }}">
                                        </td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            @if ($product->variations->count() > 0 )
                                                <span class="badge badge-success">{{ __('products.yes') }}</span>
                                                
                                            @else
                                            <span class="badge badge-danger">{{ __('products.no') }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($product->options->count() > 0)
                                                <span class="badge badge-success">{{ __('products.yes') }}</span>
                                                
                                            @else
                                            <span class="badge badge-danger">{{ __('products.no') }}</span>
                                            @endif
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
                                                        href="{{ route('update.product', $product->id) }}">{{ __('translate.edit') }}
                                                    </a>
                                                    <a class="dropdown-item"
                                                        onclick="return confirm('Are you sure you want to delete this item?')"
                                                        href="{{ route('delete.product', $product->id) }}">{{ __('translate.delete') }}</a>

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
        @include('admin.inc.setting')
    </div>
@endsection
