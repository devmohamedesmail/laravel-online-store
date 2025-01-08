<div class="fixed bottom-0 left-0 right-0 z-100 bg-white py-2 md:hidden">
    <div class="flex justify-between items-center mx-3">


        <a href="{{ route('user.index') }}" class="flex flex-col items-center justify-center">
            <i class="bi bi-house text-xl"></i>
            <p class="text-xs">{{ __('front.home')  }}</p>
        </a>



        <a href="{{ route('cart.page') }}" class="flex flex-col items-center justify-center">
            <i class="bi bi-basket2 text-xl"></i>
            <p class="text-xs">{{ __('front.cart')  }}</p>
        </a>

        <a href="{{ route('wishlist') }}" class="flex flex-col items-center justify-center">
            <i class="bi bi-heart text-xl"></i>
            <p class="text-xs">{{ __('front.wishlist')  }}</p>
        </a>

        <a href="{{ route('shop.page') }}" class="flex flex-col items-center justify-center">
            <i class="bi bi-shop-window text-xl"></i>
            <p class="text-xs">{{ __('front.shop')  }}</p>
        </a>

        <a href="{{route('shop.page')}}" class="flex flex-col items-center justify-center">
            <i class="bi bi-person text-xl"></i>
            <p class="text-xs">{{ __('front.account')  }}</p>
        </a>



    </div>
</div>