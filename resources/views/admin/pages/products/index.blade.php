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
                <div class="row d-flex justify-content-between">

                    @include('admin.pages.products.parts.add-product-details')
                    @include('admin.pages.products.parts.add-product-images')
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
            allCombinations.forEach((combination, index) => {
                const variationHTML = `
            <div class="variation-item bg-white p-3 mb-3">
                <p class="text-dark"><strong>Variation:</strong> ${combination.join(" | ")}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <label for="image_variant_${index}"  class="text-dark">
                         
                        <p>{{ __('products.select-image-variant') }}</p>
                        <input id="image_variant_${index}"  class="d-none" name="image_variant[]" type="file" class="form-control mb-2">
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
