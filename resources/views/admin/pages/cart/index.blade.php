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
                              <td>{{ $item->user->name }}</td>
                              <td>{{ $item->user->email }}</td>
                              <td><img src="/uploads/products/{{  $item->image  }}" width="50px"></td>
                              <td>{{ $item->price }}</td>
                              <td>{{ $item->sale_price }}</td>



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
