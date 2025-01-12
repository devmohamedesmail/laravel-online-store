<div class="col-12 bg-primary text-white p-2">
    {{ __('products.product-details') }}
</div>
<div class="col-12  bg-white p-3 my-2">


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
                    value="{{ $product->price }}">
                @error('price')
                    <div class="alert alert-danger my-1">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="col-12 col-md-6">
            <div class="form-group">
                <label> {{ __('products.sale-price') }} </label>
                <input type="text" class="form-control @error('sale_price') is-invalid @enderror" name="sale_price"
                    value="{{ $product->sale_price }}">
                @error('sale_price')
                    <div class="alert alert-danger my-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-12 col-md-6">
            <div class="pretty p-icon p-smooth d-flex align-items-center">
                <input type="checkbox" name="featured" value="{{ $product->featured }}"
                    @if ($product->featured) checked @endif />
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
                <input type="checkbox" name="type" id="switch" value="variations" />
                <div class="state mx-2">
                    <label class="text-dark">{{ __('products.product-type') }}</label>
                </div>
            </div>
        </div>
    </div>





    <div class="variations-section-container">
        {{-- variations and attributes --}}
        @if ($product->attributes && $product->attributes->count() > 0)
            @foreach ($product->attributes as $attribute)
                <div class="d-flex mt-4 attribute-group">
                    <div class="form-group">
                        <label>{{ __('translate.attribute-name') }}</label>
                        <input type="text" class="form-control" name="attribute_name[]"
                            value="{{ $attribute->name }}">
                    </div>
                    <div class="form-group w-100 mx-4">
                        <label>{{ __('translate.attribute-value') }} </label>
                        <div class="d-flex">
                            @foreach ($attribute->values as $value)
                                <input type="text" class="form-control" name="attribute_values[]"
                                    value="{{ $value->value }}">
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="d-flex mt-4 attribute-group">
                <div class="form-group">
                    <label>{{ __('translate.attribute-name') }}</label>
                    <input type="text" class="form-control" name="attribute_name[]">
                </div>
                <div class="form-group w-100 mx-4">
                    <label>{{ __('translate.attribute-value') }} </label>
                    <textarea class="form-control inputtags" name="attribute_values[]"></textarea>
                </div>
            </div>
        @endif
    
        <div id="attributes-container-group"></div>
    
        <div class="d-flex mt-4">
            <button id="add-attribute-btn" class="btn btn-primary mx-2">{{ __('translate.add-attribute') }}</button>
            <button id="generate-variations" class="btn btn-success mx-2">{{ __('translate.generate-variations') }}</button>
        </div>
    
        <div id="all-variation"></div> <!-- Variations will appear here -->
    </div>
    
    







</div>





<script>
  
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




<script>
    document.getElementById("generate-variations").addEventListener("click", function (event) {
        event.preventDefault();
        const allVariationsContainer = document.getElementById("all-variation");
        allVariationsContainer.innerHTML = ""; // Clear previous variations

        // Get all attribute names and values
        const attributeNames = Array.from(document.querySelectorAll('input[name="attribute_name[]"]')).map(
            input => input.value.trim()
        );
        const attributeValues = Array.from(document.querySelectorAll('textarea[name="attribute_values[]"]')).map(
            input => input.value.trim()
        );

        // Validate that both names and values are filled
        if (attributeNames.includes("") || attributeValues.includes("")) {
            alert("Please provide both attribute names and values.");
            return;
        }

        // Split values by commas and prepare combinations
        const attributeCombinations = attributeValues.map(values => values.split(",").map(value => value.trim()));

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
                <div class="variation-item bg-light p-3 mb-3">
                    <p class="text-dark p-2">${combination.join(" | ")}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="image_variant_${index}" class="text-dark">
                            <p>Select Image Variant</p>
                            <input id="image_variant_${index}" class="d-none" name="image_variant[]" type="file" class="form-control mb-2">
                            <img id="preview_image_${index}" src="#" alt="Image Preview" style="display: none; width: 100px; height: auto; margin-top: 10px;">
                        </label>
                        <div>
                            <label class="text-dark">Price</label>
                            <input type="number" class="form-control mb-2" name="price_variant[]" placeholder="Enter price">
                        </div>
                        <button class="btn btn-danger delete-btn"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            `;
            allVariationsContainer.innerHTML += variationHTML;
        });

        // Add event listeners for image previews and delete buttons
        allCombinations.forEach((_, index) => {
            const imageInput = document.getElementById(`image_variant_${index}`);
            const imagePreview = document.getElementById(`preview_image_${index}`);

            imageInput.addEventListener("change", function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = "block";
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.style.display = "none";
                }
            });

            const deleteButton = document.querySelectorAll(".delete-btn")[index];
            deleteButton.addEventListener("click", function () {
                const variationDiv = deleteButton.closest(".variation-item");
                variationDiv.remove();
            });
        });
    });
</script> 








