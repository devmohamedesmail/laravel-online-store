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
        <section class="section">


            <form action="{{ route('update.product.confirmation',$product->id) }}" method="post" enctype="multipart/form-data" id="tag-form">
                @csrf
                <div class="row d-flex justify-content-around">
                    <div class="col-12 my-3">
                        <h6 class="mx-4">{{ __('translate.update-product') }}
                        </h6>
                    </div>

                    <div class="col-12 col-md-8 col-lg-8 bg-white p-3">


                        <div class="form-group">
                            <label> {{ __('products.product-name') }} </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $product->name }}">
                            @error('name')
                                <div class="alert alert-danger my-1">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label> {{ __('products.short-description') }} </label>
                            <textarea class="form-control" name="description">{{ $product->description }}</textarea>
                        </div>


                        <div class="form-group ">
                            <label> {{ __('products.long-description') }} </label>
                            <textarea class="summernote form-control" name="long_description">
                            {{ $product->long_description }}
                             </textarea>
                        </div>



                        <div class="form-group">
                            <label>{{ __('products.select-category') }}</label>
                            <select class="form-control selectric" name="category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="alert alert-danger my-1">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="row">


                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label> {{ __('products.price') }} </label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        name="price" value="{{ $product->price }}">
                                    @error('price')
                                        <div class="alert alert-danger my-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label> {{ __('products.sale-price') }} </label>
                                    <input type="text" class="form-control @error('sale_price') is-invalid @enderror"
                                        name="sale_price" value="{{ $product->sale_price }}">
                                    @error('sale_price')
                                        <div class="alert alert-danger my-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="pretty p-icon p-smooth">
                                    <input type="checkbox" name="featured" />
                                    <div class="state p-success">
                                        <i class="icon fa fa-check"></i>
                                        <label class="form-check-label text-dark">
                                            {{ __('products.is-featured') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="pretty p-switch p-fill">
                                    <input type="checkbox" name="type" id="switch" value="variations" />
                                    <div class="state">
                                        <label class="text-dark">{{ __('products.product-type') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>













                        <div class="product-attribute-variation-container" id="product-attribute-variation-container">


                            <div class="d-flex mt-4">
                                <div class="form-group">
                                    <label>{{ __('translate.attribute-name') }}</label>
                                    <input type="text" class="form-control" name="attribute_name[]">
                                </div>
                                <div class="form-group w-100 mx-4">
                                    <label>{{ __('translate.attribute-value') }}
                                    </label>
                                    <textarea class="form-control inputtags" name="attribute_values[]"></textarea>
                                </div>
                            </div>

                            <div id="attributes-container-group">

                            </div>




                            <div class="d-flex mt-4">
                                <button id="add-attribute-btn"
                                    class="btn btn-primary mx-2">{{ __('translate.add-attribute') }}</button>
                                <button id="generate-variations"
                                    class="btn btn-success mx-2">{{ __('translate.generate-variations') }}</button>
                            </div>



                            <div id="all-variation" class="mt-4"></div>
                        </div>




                    </div>

                    <div class="col-12 col-md-3 col-lg-3 p-2 bg-white">


    <div class="text-center mt-3">
        <label for="main-image">
            <img id="preview-image" src="/uploads/products/{{ $product->image }}" width="100px" alt="">
            <input id="main-image" type="file" class="d-none" name="image" onchange="previewImage(event)">
            <p class="text-center mt-2 text-dark">{{ __('products.main-image') }}</p>
        </label>

        @error('image')
            <div class="alert alert-danger my-1">{{ $message }}</div>
        @enderror
    </div>


    <hr>

    <div class="text-center">
        <div class="gallery"></div>
        <label for="gallery-input">
            <img id="gallery" src="/templates/admin/assets/icons/picture.png" width="100px" alt="">

            <input id="gallery-input" class="d-none" type="file" multiple name="gallery[]"
                onchange="galleryPreview(event)">
            <p class="text-center mt-2 text-dark">{{ __('products.add-images') }}</p>
        </label>

    </div>


    <div class="text-center ">
        <button class="btn btn-primary w-50" type="submit">{{ __('translate.add') }}</button>
    </div>

</div>
                </div>

            </form>
        </section>

        @include('admin.inc.setting')

    </div>


    <script>
        document.getElementById("generate-variations").addEventListener("click", function(event) {
            event.preventDefault();
            const allVariationsContainer = document.getElementById("all-variation");
            allVariationsContainer.innerHTML = ""; // Clear previous variations

            // Get all attribute names and values
            const attributeNames = Array.from(document.querySelectorAll('input[name="attribute_name[]"]')).map(
                input => input.value.trim()
            );
            const attributeValues = Array.from(document.querySelectorAll('textarea[name="attribute_values[]"]'))
                .map(
                    input => input.value.trim()
                );

            // Validate that both names and values are filled
            if (attributeNames.includes("") || attributeValues.includes("")) {
                alert("Please provide both attribute names and values.");
                return;
            }

            // Split values by commas and prepare combinations
            const attributeCombinations = attributeValues.map(values => values.split(",").map(value => value
                .trim()));

            // Helper function to generate all combinations
            function generateCombinations(arrays) {
                const result = [];
                const helper = (prefix, remainingArrays) => {
                    if (remainingArrays.length === 0) {
                        result.push(prefix);
                        return;
                    }
                    remainingArrays[0].forEach(value => {
                        helper([...prefix, value], remainingArrays.slice(1));
                    });
                };
                helper([], arrays);
                return result;
            }

            // Generate all combinations of attributes
            const allCombinations = generateCombinations(attributeCombinations);

            // Display each combination as a variation
            allCombinations.forEach(combination => {
                const variationHTML = `
            <div class="variation-item bg-white p-3 mb-3">
                <p class="text-dark"><strong>Variation:</strong> ${combination.join(" | ")}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <label for="image" class="text-dark">
                        <i class="fas fa-images fs-1"></i>
                        <input id="image" class="d-none" name="image_variant[]" type="file" class="form-control mb-2">
                    </label>
                    <div>
                        <label class="text-dark">{{ __('Price') }}</label>
                        <input type="number" class="form-control mb-2" name="price_variant[]" placeholder="Enter price">
                    </div>
                    <div>
                        <label class="text-dark">{{ __('Sale Price') }}</label>
                        <input type="number" class="form-control mb-2" name="sale_price_variant[]" placeholder="Enter sale price">
                    </div>
                    <button class="btn btn-danger delete-btn"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        `;
                allVariationsContainer.innerHTML += variationHTML;
            });

            // Add event listeners to delete buttons for each variation
            document.querySelectorAll(".delete-btn").forEach(button => {
                button.addEventListener("click", function() {
                    const variationDiv = button.closest(".variation-item");
                    variationDiv.remove();
                });
            });
        });
    </script>

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
