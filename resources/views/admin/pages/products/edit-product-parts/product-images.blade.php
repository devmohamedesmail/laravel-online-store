<div class="col-12 bg-primary text-white p-2">
    {{ __('products.product-images') }}
</div>
<div class="col-12  p-2 bg-white my-2">


    <div class="row">
        <div class="text-center mt-3 col-12 col-md-6">
            <label for="main-image">
                <img id="preview-image" src="/uploads/{{ $product->image }}" width="100px" alt="">
                <input id="main-image" type="file" class="d-none" name="image"
                    onchange="previewImage(event)">
                <p class="text-center mt-2 text-dark">{{ __('products.main-image') }}</p>
            </label>

            @error('image')
                <div class="alert alert-danger my-1">{{ $message }}</div>
            @enderror
        </div>


     

        <div class="text-center col-12 col-md-6">
            <div class="gallery"></div>
            <label for="gallery-input">
                <img id="gallery" src="/templates/admin/assets/icons/picture.png" width="100px"
                    alt="">

                <input id="gallery-input" class="d-none" type="file" multiple name="gallery[]"
                    onchange="galleryPreview(event)">
                <p class="text-center mt-2 text-dark">{{ __('products.add-images') }}</p>
            </label>

        </div>
    </div>




</div>