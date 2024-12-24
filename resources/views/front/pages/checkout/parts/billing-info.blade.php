<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 sm-margin-30px-bottom">
    <div class="create-ac-content bg-light-gray padding-20px-all">
        <form>
            <fieldset>
                <h2 class="login-title mb-3">Billing details</h2>
                <div class="row">

                    <div class="form-group col-12 required">
                        <label for="input-firstname">{{ __('front.name') }} </label>
                        <input name="firstname" value="" id="input-firstname" type="text">
                    </div>

                    <div class="form-group col-12 required">
                        <label for="input-firstname">{{ __('front.phone') }} </label>
                        <input name="firstname" value="" id="input-firstname" type="text">
                    </div>

                    <div class="form-group col-12 required">
                        <label for="input-firstname">{{ __('front.address') }} </label>
                        <input name="firstname" value="" id="input-firstname" type="text">
                    </div>



                    <div class="form-group col-12 required">
                        <label for="input-country"> {{ __('front.select-country') }} </label>
                        <select name="country_id" id="input-country">
                            @foreach ($countries as $country)
                                <option value="244">{{ $country->country_en }}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="form-group col-12 required">
                        <label for="input-city">{{ __('front.select-city') }}</label>
                        <select name="city_id" id="input-city" class="form-control">
                            <option value="">{{ __('front.select-city') }}</option>
                        </select>
                    </div>
                </div>

            </fieldset>





            <fieldset>
                <div class="row">
                    <div class="form-group col-md-12 col-lg-12 col-xl-12">
                        <label for="input-company">{{ __('front.note') }}</label>
                        <textarea class="form-control resize-both" rows="3"></textarea>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>