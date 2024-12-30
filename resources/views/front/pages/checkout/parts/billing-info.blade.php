<div class="first-column">
    <h4 class="text-center text-xl text-gray-600">{{ __('front.billing_details') }}</h4>

    <div>
        <div class="input-container my-4">
            <label class="block text-sm">{{ __('front.name') }}</label>
            <input type="text" class="input w-full @error('name') is-invalid @enderror" name="name" />
            @error('name')
                <span class="text-red-600">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="input-container my-4">
            <label class="block text-sm">{{ __('front.phone') }}</label>
            <input type="text" class="input w-full @error('phone') is-invalid @enderror" name="phone" />
            @error('phone')
                <span class="text-red-600">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <div class="input-container my-4">
            <label class="block text-sm">{{ __('front.address') }}</label>
            <input type="text" class="input w-full @error('address') is-invalid @enderror"
                name="address" />
            @error('address')
                <span class="text-red-600">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <div class="input-container my-4">
            <label for="input-country" class="block text-sm"> {{ __('front.select-country') }} </label>
            <select name="country" id="input-country"
                class="border-gray-300 border w-full py-2 focus:outline-none">
                <option value="">{{ __('front.select-country') }}</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->country_en }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="input-container my-4">
            <label for="input-city" class="block text-sm">{{ __('front.select-city') }}</label>
            <select name="city" id="input-city"
                class="border-gray-300 border w-full py-2 focus:outline-none">
                <option value="">{{ __('front.select-city') }}</option>
            </select>
        </div>




    </div>
</div>




<script>
  document.getElementById('input-country').addEventListener('change', function() {
   
    const country = this.value; 
    const citySelect = document.getElementById('input-city');
    
    // Clear previous options
    citySelect.innerHTML = '<option value="">{{ __('front.select-city') }}</option>';
    
    if (country) {
        fetch(`/cities/${country}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                data.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.city_ar; 
                    option.textContent = city.city_ar;
                    citySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching cities:', error));
    }
});

</script>
