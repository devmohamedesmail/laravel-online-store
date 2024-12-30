
<div class="container m-auto">
    <h5 class="text-center text-xl my-5">{{ __('front.categories') }}</h5>
    <div class="grid grid-cols-3 md:grid-cols-6 lg:grid-cols-7 gap-4 px-3 m-auto  items-center">

        @foreach ($categories as $category)
            <div class="flex flex-col items-center justify-center mb-4">
                <a href="{{ route('shop.page',  $category->id) }}" class="block w-24 h-24 md:w-32 md:h-32 rounded-full overflow-hidden">
                    <img src="/uploads/{{ $category->image }}" style="object-fit: cover !important;"
                        alt="{{ $category->description }}">
                </a>
                <p class="text-center bold mt-3"> {{ $category->name }}</p>
                </p>
            </div>
        @endforeach

    </div>
</div>
