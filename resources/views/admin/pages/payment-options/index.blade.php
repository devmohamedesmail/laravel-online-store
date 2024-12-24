@extends('admin.layout')

@section('content')
    <div class="main-content">


        <div class="row">
            <div class="col-12 col-md-5">
                <div class="section my-3 bg-white py-3">
                    <form action="{{ route('add.new.payment') }}" method="post" enctype="multipart/form-data" id="tag-form">
                        @csrf
                        <div class="col-12 ">
        
                            <div class="form-group">
                                <label> {{ __('translate.name_en') }} </label>
                                <div class="input-group">
        
                                    <input type="text" class="form-control" name="type_en">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <label> {{ __('translate.name_ar') }} </label>
                                <div class="input-group">
        
                                    <input type="text" class="form-control" name="type_ar">
                                </div>
                            </div>
                        </div>
        
                        <div class="col-12 ">
                           <button class="btn btn-primary" type="submit">{{ __('translate.add')  }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="section my-3">
                    <div class="col-12 ">
                        <div class="bg-white p-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>{{ __('translate.name_en') }}</th>
                                            <th>{{ __('translate.name_ar') }}</th>
                                           
                                            <th>{{ __('translate.status') }}</th>
                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($paymentmethod as $method)
                                            <tr>
                                                <td>
                                                    {{ $method->type_en }}
                                                    
                                                </td>
                                                <td>
                                                    {{ $method->type_ar }}
                                                   
                                                </td>
        
        
                                                <td>
                                                   
                                                    @if ($method->status == 1)
                                                        
                                                        <a href="{{ route('toggle.active.payment', $method->id) }}" class="btn btn-success">{{ __('translate.active') }}</a>
                                                        
                                                    @else
                                                        <a href="{{ route('toggle.active.payment', $method->id) }}" class="btn btn-danger">{{ __('translate.not-active') }}</a>
                                                    @endif
                                                    
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
        </div>
       



    


        @include('admin.inc.setting')
    </div>
@endsection
