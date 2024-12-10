<div class="col-12 col-md-3 col-lg-3 p-2 bg-white">


    <div class="text-center mt-3">
        <label for="main-image">
            <img id="preview-image" src="/templates/admin/assets/icons/image.png" width="100px" alt="">
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
