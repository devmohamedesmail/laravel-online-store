<div class="flex justify-evenly my-4">
    <div
        class="flex-1 border rounded-md py-7 border-gray-300 p-2 mr-2  flex flex-col justify-center items-center">
        <i class="bi bi-truck text-2xl text-primary"></i>
        <p class="text-sm">{{ __('front.free-delivery') }}</p>
    </div>

    <div
        class="flex-1 border rounded-md py-7 border-gray-300 p-2 mr-2  flex flex-col justify-center items-center">

        <i class="bi bi-arrow-clockwise text-2xl text-primary"></i>
        <p class="text-sm">{{ __('front.return') }}</p>
    </div>

    <div
        class="flex-1 border rounded-md py-7  border-gray-300 p-2 mr-2 flex flex-col justify-center items-center">

        <i class="bi bi-stripe text-2xl text-primary"></i>
        <p class="text-sm">{{ __('front.safe-payment') }}</p>
    </div>
</div>

<div>
    <p class="text-sm my-2 bg-gray-100 p-3 text-center">
        {{ __('front.guarantee') }}
    </p>
</div>

<div class="flex justify-center items-center">
    <img src="/templates/front/images/payment.png" class="my-4 w-70 h-12" alt="">
</div>