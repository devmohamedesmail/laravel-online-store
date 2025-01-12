@extends('admin.layout')

@section('content')
    <div class="main-content">
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



        <section class="section" style="margin-bottom: 100px">


            <form action="{{ route('add.new.product') }}" method="post" enctype="multipart/form-data" id="tag-form">
                @csrf
                <h6 class="row bg-white text-dark p-2">{{ __('translate.add-new-product') }}</h6>
                <div class="row d-flex justify-content-center">

                    @include('admin.pages.products.parts.add-product-details')
                    @include('admin.pages.products.parts.add-product-images')
                    @include('admin.pages.products.parts.options-section')
                </div>

            </form>
        </section>

        @include('admin.inc.setting')

    </div>


  

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.5/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



  
@endsection
