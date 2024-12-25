<div class="col-12 col-md-9 col-lg-9 bg-white p-3 ">


    <div class="form-group">
        <label> {{ __('products.product-name') }} </label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name') }}">
        @error('name')
            <div class="alert alert-danger my-1">{{ $message }}</div>
        @enderror
    </div>



    <div class="form-group">
        <label> {{ __('products.short-description') }} </label>
        <textarea class="form-control" name="description">{{ old('description') }}</textarea>
    </div>


    <div class="form-group ">
        <label> {{ __('products.long-description') }} </label>
        <textarea class="summernote form-control" name="long_description">
            {{ old('long_description') }}
        </textarea>
    </div>



    <div class="form-group">
        <label>{{ __('products.select-category') }}</label>
        <select class="form-control selectric" name="category">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
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
                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"
                    value="{{ old('price') }}">
                @error('price')
                    <div class="alert alert-danger my-1">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="col-12 col-md-6">
            <div class="form-group">
                <label> {{ __('products.sale-price') }} </label>
                <input type="text" class="form-control @error('sale_price') is-invalid @enderror" name="sale_price"
                    value="{{ old('sale_price') }}">
                @error('sale_price')
                    <div class="alert alert-danger my-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-12 col-md-6">
            <div class="pretty p-icon p-smooth d-flex align-items-center">
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
            <div class="pretty p-switch p-fill d-flex align-items-center">
                <input type="checkbox" name="type" id="switch" value="variable" />
                <div class="state mx-2">
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
            <button id="add-attribute-btn" class="btn btn-primary mx-2">{{ __('translate.add-attribute') }}</button>
            <button id="generate-variations"
                class="btn btn-success mx-2">{{ __('translate.generate-variations') }}</button>
        </div>



        <div id="all-variation" class="mt-4"></div>
    </div>




</div>



<script>
    const switchBtn = document.getElementById('switch');
    const attributeContainer = document.getElementById('product-attribute-variation-container').style.display = 'none';

    switchBtn.addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('product-attribute-variation-container').style.display = 'block';
        } else {
            document.getElementById('product-attribute-variation-container').style.display = 'none';
        }
    })


    document.getElementById("add-attribute-btn").addEventListener("click", function(event) {
        event.preventDefault();
        console.log("new attribute added");

        const attributeGroup = document.createElement("div");
        attributeGroup.classList.add("d-flex");

        attributeGroup.innerHTML = `
        <div class="form-group">
            <label>{{ __('translate.attribute-name') }}</label>
            <input type="text" class="form-control" name="attribute_name[]">
        </div>
        <div class="form-group w-100 mx-4">
            <label>{{ __('translate.attribute-value') }} </label>
            <textarea class="form-control inputtags" name="attribute_values[]"></textarea>
        </div>
    `;

        // Append the new group to the container
        document.getElementById("attributes-container-group").appendChild(attributeGroup);

        // Reinitialize tagsinput for the newly added textarea
        $(attributeGroup).find(".inputtags").tagsinput();
    });
</script>
