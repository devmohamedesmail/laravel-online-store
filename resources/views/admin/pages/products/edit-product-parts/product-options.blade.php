<div class="col-12 bg-primary text-white p-2">
    {{ __('products.product-options') }}
</div>
<div class="col-12 bg-white p-3 my-2">

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" type="button"
            id="add-option-btn">{{ __('products.add-option') }}</button>
    </div>




  

    @if ($product->options->count() > 0)
        @foreach ($product->options as $index => $option)
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="option-name-{{ $index }}">{{ __('products.option-name') }}</label>
                        <input type="text" class="form-control" name="option_name[]"
                            id="option-name-{{ $index }}" value="{{ $option->name }}">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="option-price-{{ $index }}">{{ __('products.option-price') }}</label>
                        <input type="text" class="form-control" name="option_price[]"
                            id="option-price-{{ $index }}" value="{{ $option->price }}">
                    </div>
                </div>
                <!-- Hidden field to pass the option ID -->
                <input type="hidden" name="option_ids[]" value="{{ $option->id }}">
               
            </div>
        @endforeach
    @endif




    <div id="options-container">
        <!-- Initially empty, will be populated via JavaScript -->
    </div>