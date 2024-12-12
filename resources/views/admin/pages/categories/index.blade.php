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
                <div class="col-12 col-md-5">
                    <div class="p-3 bg-white">
                        <h5 class="text-dark"> {{ __('translate.add_maincategory') }} </h5>
                        <form action="{{ route('add.category') }}" method="post" enctype="multipart/form-data" id="tag-form">
                            @csrf
                            <div class="form-group">
                                <label> {{ __('products.category-name') }} </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="category_name" onchange="generateSlug()"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <div class="alert alert-danger my-1">{{ $message }}</div>
                                @enderror
                            </div>




                            <div class="form-group">
                                <label> {{ __('products.slug') }} </label>
                                <input type="text" class="form-control" name="slug" readonly
                                    value="{{ old('slug') }}" id="slug">
                                @error('slug')
                                    <div class="alert alert-danger my-1">{{ $message }}</div>
                                @enderror
                            </div>









                            <div class="form-group">
                                <label>{{ __('translate.select-category') }}</label>
                                <select class="form-control selectric" name="parent_id">

                                    <option value="0" selected>{{ __('parent') }}</option>

                                    @if ($categories->count() > 0)
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif


                                </select>
                            </div>

                            <div class="form-group">
                                <label> {{ __('translate.description') }} </label>
                                <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                            </div>





                            <div class="form-group">
                                <label for='category-image'>
                                    <img id="preview-image" src="/templates/admin/assets/icons/image.png" width="100px"
                                        alt="{{ $setting->description }}">
                                    <input id='category-image' type="file" class="form-control d-none" name="image" onchange="previewImage(event)">
                                    <p class="text-dark">{{ __('products.category-image') }} </p>
                                </label>

                                @error('image')
                                    <div class="alert alert-danger my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="btn btn-primary" type="submit"> {{ __('translate.add') }} </button>
                        </form>
                    </div>
                </div>
                @include('admin.pages.categories.parts.categories-table')
            </div>

        </section>


        @include('admin.inc.setting')

        <script>
            function previewImage(event) {
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Set the src of the image to the selected file
                    document.getElementById('preview-image').src = e.target.result;
                };

                // Only read the image if a file is selected
                if (file) {
                    reader.readAsDataURL(file);
                }
            }
        </script>


    </div>



@endsection
