<div class="container">
    <h4 class="text-center h2">{{ __('front.categories') }}</h4>

    <div class="row d-flex justify-content-between flex-wrap my-3">
        @foreach ($categories as $category)
            <a href="#" class="col-4  p-3 col-md-2 d-flex justify-content-center align-items-center flex-column " style="text-decoration: none; overflow: hidden !important;">
             
                <div style="width: 100px; height: 100px; overflow: hidden !important; border-radius: 100%;">
                    <img src="/uploads/{{ $category->image }}" style="object-fit: cover !important;"  alt="{{ $category->description }}">
                </div>
                <p class="text-center fw-bold fs-1" style="font-weight: bold; font-size: 14px; margin-top: 10px">{{ $category->name }}</p>
            </a>
        @endforeach
    </div>
</div>
