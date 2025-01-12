<form action="{{ route('update.payment.setting') }}" method="POST">
    @csrf
    <div class="row px-5">
        <div class="col-12">
            <h5 class="text-dark">{{ __('translate.stripe-setting') }}</h5>
            <div class="row">
                <div class="form-group col-12 col-md-6">
                    <label>{{ __('translate.stripe-key') }}</label>
                    <input type="text" class="form-control" name="stripe_key" value="{{ $paymentSetting->stripe_key }}">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label>{{ __('translate.stripe-secret') }}</label>
                    <input type="text" class="form-control" name="stripe_secret" value="{{ $paymentSetting->stripe_secret }}">
                </div>
            </div>
        </div>
    
        <div class="col-12">
            <h5 class="text-dark">{{ __('translate.paypal-setting') }}</h5>
            <div class="row">
                <div class="form-group col-12 col-md-6">
                    <label>{{ __('translate.paypal-key') }}</label>
                    <input type="text" class="form-control" name="paypal_client_id" value="{{ $paymentSetting->paypal_client_id }}">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label>{{ __('translate.paypal-secret') }}</label>
                    <input type="text" class="form-control" name="paypal_secret" value="{{ $paymentSetting->paypal_secret }}">
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">{{ __('translate.save') }}</button>
    </div>
</form>