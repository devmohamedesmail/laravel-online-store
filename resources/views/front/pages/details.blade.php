@extends('front.layout')

@section('content')
    @include('front.inc.top-header')
    @include('front.inc.header')






    @if (session('success'))
        <script>
            iziToast.success({
                title: 'Success',
                message: '{{ session('success') }}',
                position: 'topRight',
                timeout: 3000
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            iziToast.success({
                title: 'Error',
                message: '{{ session('error') }}',
                position: 'topRight',
                timeout: 3000
            });
        </script>
    @endif






    <div class="conatiner m-auto px-3 md:px-20">
        <div>
            <a href="{{ route('user.index') }}" class="text-primary text-xs">{{ __('front.home') }}</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <a href="{{ route('product.details', [$product->id, \Illuminate\Support\Str::slug($product->name)]) }}"
                class="text-priamry text-xs">{{ $product->name }}</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 m-auto bg-priamry p-2 gap-3">



            <div class="images-gallery ">

                <div class="main-gallery flex justify-center items-center overflow-hidden" style="height: 400px;">
                    <img id="mainImage" src="{{ asset('/uploads/' . $product->image) }}" class="object-cover h-full w-full"
                        alt="Product Image" />
                </div>


                @if ($product->gallery != null)
                    <div class="relative mt-4">
                        <button onclick="scrollThumbnails(-100)"
                            class="absolute left-0 top-5 bottom-0 z-10 rounded-full w-10 h-10 bg-gray-200 p-2 text-gray-700 hover:bg-gray-300">
                            &#9664;
                        </button>
                        <div class="thumbnail-gallery flex justify-center space-x-2 overflow-x-auto scroll-smooth px-8">
                            <!-- Thumbnails -->
                            @foreach ($product->gallery as $img)
                                <div class="thumbnail border border-gray-300 overflow-hidden cursor-pointer w-14 h-14">
                                    <img src="{{ asset('/uploads/' . $img) }}" class="w-full h-full object-cover"
                                        alt="Thumbnail" onclick="updateMainImage('{{ asset('/uploads/' . $img) }}')" />
                                </div>
                            @endforeach
                        </div>
                        <button onclick="scrollThumbnails(100)"
                            class="absolute right-0 top-5 bottom-0 z-10 rounded-full w-10 h-10 bg-gray-200 p-2 text-gray-700 hover:bg-gray-300">&#9654;</button>
                    </div>
                @endif
            </div>


            {{-- include product details --}}
            @include('front.single-product.product-details')

        </div>


    </div>


    </div>
    <div class="container m-auto">
        <div class="text-center">
            {!! $product->long_description !!}
        </div>
    </div>
    @include('front.inc.footer')
    @include('front.inc.bottom-navbar')


    <script>
        // Function to update the main image
        function updateMainImage(imageSrc) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = imageSrc;
        }

        // Function to scroll the thumbnail gallery
        function scrollThumbnails(amount) {
            const gallery = document.querySelector('.thumbnail-gallery');
            gallery.scrollBy({
                left: amount,
                behavior: 'smooth'
            });
        }
    </script>


    <script>
        document.querySelectorAll('.variation-option').forEach(option => {
            option.addEventListener('change', function() {
                const selectedPrice = this.getAttribute('data-price');

                const priceDisplay = document.getElementById('selected-variation-price');
                priceDisplay.textContent = selectedPrice;
                document.getElementById('product-price-range').innerHTML = selectedPrice;

            });
        });
    </script>

@endsection
