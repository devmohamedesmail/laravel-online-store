@extends('admin.layout')

@section('content')
<div class="main-content">
 

    <div class="row">
        <div class="col-12 col-md-6">

            <form action="{{ route('add.country') }}" method="post" id="tag-form">
                @csrf
                <div class="form-group">
                    <label> {{ __('countries.country_en') }} </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        name="country_en"
                         />
                   
                </div>
                <div class="form-group">
                    <label> {{ __('countries.country_ar') }} </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        name="country_ar"
                         />
                   
                </div>
                <button class="btn btn-primary" type="submit">{{ __('translate.add') }}</button>
            </form>
        </div>



        <div class="col-12 col-md-6">

            <form action="{{ route('add.city') }}" method="post" id="tag-form">
                @csrf



                <div class="form-group">
                    <label>{{ __('countries.select_country') }}</label>
                    <select class="form-control selectric" name="country">

                        

                        @if ($categories->count() > 0)
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->country_en }}</option>
                            @endforeach
                        @endif


                    </select>
                </div>



                <div class="form-group">
                    <label> {{ __('countries.city_en') }} </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        name="city_en"
                         />
                   
                </div>
                <div class="form-group">
                    <label>{{ __('countries.city_ar') }} </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        name="city_ar"
                         />
                   
                </div>
                <button class="btn btn-primary" type="submit">{{ __('translate.add') }}</button>
            </form>
        </div>
    </div>



  @include('admin.inc.setting')
</div>
@endsection
