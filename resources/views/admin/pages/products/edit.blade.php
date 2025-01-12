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

        <h6 class="row bg-white text-dark p-2">{{ __('translate.edit') }}</h6>


        <section class="section">


            <form action="{{ route('update.product.confirmation', $product->id) }}" method="post"
                enctype="multipart/form-data" id="tag-form">
                @csrf
                <div class="row d-flex justify-content-center  my-3">


                   @include('admin.pages.products.edit-product-parts.product-details')



                   {{-- ------------------------ product images ------------------------------------ --}}
                  @include('admin.pages.products.edit-product-parts.product-images')

                   

                    




                  {{-- ------------------------------------------- Option Section -------------------------------- --}}
                   @include('admin.pages.products.edit-product-parts.product-options')



                        <div class="text-center ">
                            <button class="btn btn-primary w-50" type="submit">{{ __('translate.update') }}</button>
                        </div>

                    </div>






















                </div>

            </form>
        </section>

        @include('admin.inc.setting')

    </div>









    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.5/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <script>
        // preview image
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


        // priview more images

        function galleryPreview(event) {
            const files = event.target.files; // Get the list of files
            const galleryContainer = document.querySelector('.gallery'); // The container where images will be displayed
            galleryContainer.innerHTML = ''; // Clear the existing gallery (if any)

            // Loop through each selected file
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Create an img element to display the image
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.width = 100; // Set the width for the images
                    imgElement.alt = 'Gallery Image';
                    imgElement.style.margin = '5px'; // Optional: Add some space between images

                    // Append the image to the gallery container
                    galleryContainer.appendChild(imgElement);
                };

                // Read the file as a data URL
                reader.readAsDataURL(file);
            }
        }
    </script>








@endsection
