<div class="col-12 bg-primary text-white p-2">
    {{ __('products.product-images') }}
</div>

<div class="col-12  p-3 bg-white my-2">


  <div class="row">
    <div class="text-center mt-3 col-12 col-md-6">
        <label for="main-image">
            <img id="preview-image" src="/templates/admin/assets/icons/image.png" width="100px" alt="">
            <input id="main-image" type="file" class="d-none" name="image" onchange="previewImage(event)">
            <p class="text-center mt-2 text-dark">{{ __('products.main-image') }}</p>
        </label>

        @error('image')
            <div class="alert alert-danger my-1">{{ $message }}</div>
        @enderror
    </div>


  

    <div class="text-center col-12 col-md-6">
        <div class="gallery"></div>
        <label for="gallery-input">
            <img id="gallery" src="/templates/admin/assets/icons/picture.png" width="100px" alt="">

            <input id="gallery-input" class="d-none" type="file" multiple name="gallery[]"
                onchange="galleryPreview(event)">
            <p class="text-center mt-2 text-dark">{{ __('products.add-images') }}</p>
        </label>

    </div>
  </div>


</div>


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
