<div class="container">
    <h4 class="text-center h2">categories</h4>

    <div class="row d-flex justify-content-center my-3">
        @foreach ($categories as $category)
            <a href="#" class="col-3 col-md-2 d-flex justify-content-center align-items-center flex-column">
                <img src="/uploads/category/{{ $category->image }}" width="100%" alt="{{ $category->description }}">
                <p class="text-center">{{ $category->name }}</p>
            </a>
        @endforeach
    </div>
</div>
