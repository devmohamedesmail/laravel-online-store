<div class="col-12 bg-primary text-white p-2">
    {{ __('products.product-options') }}
</div>
 <div class="col-12 bg-white p-3 my-2">

     <div class="d-flex justify-content-end">
        <button class="btn btn-primary" type="button" id="add-option-btn">{{ __('products.add-option') }}</button>
     </div>

    {{-- <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label> {{ __('products.option-name') }} </label>
                <input type="text" class="form-control @error('option_name') is-invalid @enderror" name="option_name"
                    value="{{ old('option_name') }}" >
                @error('option_name')
                    <div class="alert alert-danger my-1">{{ $message }}</div>
                @enderror
            </div>
        </div>



        <div class="col-12 col-md-6">
            <div class="form-group">
                <label> {{ __('products.option-price') }} </label>
                <input type="text" class="form-control @error('option_price') is-invalid @enderror" name="option_price"
                    value="{{ old('option_price') }}" >
                @error('option_price')
                    <div class="alert alert-danger my-1">{{ $message }}</div>
                @enderror
            </div>
        </div>



       



    </div> --}}

    <div id="options-container">
        <!-- Initially empty, will be populated via JavaScript -->
    </div>



    <div class="text-center ">
        <button class="btn btn-primary w-50" type="submit">{{ __('translate.add') }}</button>
    </div>

 </div>




 <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        let optionCount = 0;  // Keeps track of how many rows are added

        // Event listener for "Add Option" button
        document.getElementById('add-option-btn').addEventListener('click', function() {
            optionCount++;

            // Create new row of input fields
            let row = document.createElement('div');
            row.classList.add('row');
            row.innerHTML = `
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="option-name-${optionCount}">{{ __('products.option-name') }}</label>
                        <input type="text" class="form-control" name="option_name[]" id="option-name-${optionCount}">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="option-price-${optionCount}">{{ __('products.option-price') }}</label>
                        <input type="text" class="form-control" name="option_price[]" id="option-price-${optionCount}">
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-danger remove-option-btn">{{ __('Delete') }}</button>
                </div>
            `;

            // Append the new row to the container
            document.getElementById('options-container').appendChild(row);

            // Attach event listener for the delete button in the new row
            row.querySelector('.remove-option-btn').addEventListener('click', function() {
                row.remove();
            });
        });
    });
</script>
