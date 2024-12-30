

<footer class="bg-black py-10">
    <div class="container m-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4  gap-4">


            <div class="">
                <img src="/uploads/setting/{{ $setting->logo }}" width="100px" alt="{{ $setting->name }}">
            </div>



            <div class="">
                <h4 class="text-white font-bold text-xl">{{ __('front.categories') }}</h4>
                <ul class="mt-4">
                    @foreach ($categories as $category)
                        <li class="text-white"><a href="#">{{ $category->name }}</a></li>
                    @endforeach


                </ul>
            </div>





            <div class="">
                <h4 class="text-white font-bold text-xl">{{ __('front.customer-services') }}</h4>
                <ul>

                    <li class="text-white"><a href="{{ route('contact.page') }}">{{ __('front.contact') }}</a></li>

                </ul>
            </div>

            <div >
                <h4  class="text-white font-bold text-xl">{{ __('front.contact-us') }}</h4>
                <ul class="addressFooter">

                    <li class="flex items-center">
                        <i class="bi bi-telephone text-white"></i>
                        <p class="text-white">{{ $setting->phone }}</p>
                    </li>
                    <li class="flex items-center">
                        <i class="bi bi-envelope text-white"></i>
                        <p class="text-white">{{ $setting->email }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
