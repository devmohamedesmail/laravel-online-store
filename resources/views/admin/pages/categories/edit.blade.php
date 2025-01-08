@extends('admin.layout')

@section('content')
    <div class="main-content">
        <section class="section">
            @if (session('success'))
                <script>
                    iziToast.success({
                        title: 'Success',
                        message: '{{ session('success') }}',
                        position: 'topRight', // You can adjust the position of the toast
                        timeout: 3000 // Timeout in ms (3 seconds)
                    });
                </script>
            @endif

            <div class="row">
              <div class="col-12">
                @include('admin.inc.back')
              </div>
            </div>
            <div class="row">
               
                <div class="col-12 ">
                    <div class="p-3 bg-white">
                        <h5 class="text-dark"> {{ __('translate.update-category') }} </h5>
                        <form action="{{ route('edit.category.confirmation', $category->id) }}" method="post"
                            enctype="multipart/form-data" id="tag-form">
                            @csrf
                            <div class="form-group">
                                <label> {{ __('translate.name_en') }} </label>
                                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                            </div>




                            <div class="form-group">
                                <label>{{ __('translate.select-category') }}</label>
                                <select class="form-control selectric" name="parent_id">

                                    <option value="0" selected>{{ __('parent') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach


                                </select>
                            </div>

                            <div class="form-group">
                                <label> {{ __('translate.description') }} </label>
                                <textarea class="form-control" name="description">
                                   {{ $category->description }}
                                </textarea>
                            </div>


                             <div>
                                <img src="/uploads/{{ $category->image }}" alt="{{ $category->name }}" style="width: 100px;">
                             </div>




                            <div class="form-group">
                                <label> {{ __('translate.image') }} </label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <button class="btn btn-primary" type="submit"> {{ __('translate.update') }} </button>
                        </form>
                    </div>

                </div>

            </div>




        </section>
        @include('admin.inc.setting')
    </div>
@endsection
