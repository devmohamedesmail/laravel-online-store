@extends('admin.layout')

@section('content')
    <div class="main-content">
        <div class="section my-3">
            <form action="{{ route('add.new.slider') }}" method="post" enctype="multipart/form-data" id="tag-form">
                @csrf

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label> {{ __('translate.title') }} </label>
                        <input type="text" class="form-control" name="title" >
                    </div>
                </div>


                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label> {{ __('translate.description') }} </label>
                        <input type="text" class="form-control" name="description" >
                    </div>
                </div>



                <div class="custom-file mt-3 col-12 col-md-6">
                    <input type="file" class="custom-file-input" id="customFile" required name="image">
                    <label class="custom-file-label" for="customFile">{{ __('translate.choose-image') }}</label>
                </div>


                <div class="custom-file mt-3 col-12 col-md-6">
                    <button class="btn btn-primary" type="submit">{{ __('translate.add') }}</button>
                </div>


                



            </form>
        </div>


        <div class="section my-3">
            <div class="row">
                @foreach ($sliders as $slider )
                <div class="col-12 col-md-6">
                   <img src="/uploads/sliders/{{ $slider->image }}" width="100%" alt="{{ $slider->title }}">
                   <h6>{{ $slider->title  }}</h6>
                   <h6>{{ $slider->description }}</h6>
                   <a href="{{ route('delete.slider', $slider->id) }}" class="btn btn-danger">{{ __('translate.delete') }}</a>
                </div>  
                @endforeach
              
            </div>
        </div>
        @include('admin.inc.setting')
    </div>
@endsection
