
<div class="container m-auto">
    <h5 class="text-center text-3xl my-5 font-bold">{{ __('front.categories') }}</h5>
    <div class="grid grid-cols-3 md:grid-cols-6 lg:grid-cols-7 gap-3 px-3 m-auto justify-center  items-center">

        @foreach ($categories as $category)
            <div class="flex flex-col items-center justify-center rounded-lg mb-4 pb-2">
                <a  
                href="{{ route('shop.page',  $category->id) }}" 
                class="flex justify-center items-center  overflow-hidden ">
                    <img src="/uploads/{{ $category->image }}" class=" rounded-full w-28 h-28 md:w-36 md:h-36 object-cover"
                        alt="{{ $category->description }}">
                </a>
                <p class="text-center text-xs bold mt-3"> {{ $category->name }}</p>
                </p>
            </div>
        @endforeach

    </div>
</div>
