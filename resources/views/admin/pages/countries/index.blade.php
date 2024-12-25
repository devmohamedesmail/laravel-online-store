@extends('admin.layout')

@section('content')
    <div class="main-content">

        <h6 class="row bg-white text-dark p-2">{{ __('countries.countries') }}</h6>
        <div class="row bg-white py-3">
            <div class="col-12 col-md-6 bg-white">

                <form action="{{ route('add.country') }}" method="post" id="tag-form">
                    @csrf
                    <div class="form-group">
                        <label> {{ __('countries.country_en') }} </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="country_en" />

                    </div>
                    <div class="form-group">
                        <label> {{ __('countries.country_ar') }} </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="country_ar" />

                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('translate.add') }}</button>
                </form>
            </div>



            <div class="col-12 col-md-6 bg-white">

                <form action="{{ route('add.city') }}" method="post" id="tag-form">
                    @csrf

                    <div class="form-group">
                        <label>{{ __('countries.select_country') }}</label>
                        <select class="form-control selectric" name="country">



                            @if ($categories->count() > 0)
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">
                                        @if (app()->getLocale() == 'en')
                                        {{ $country->country_en }}
                                        @else
                                        {{ $country->country_ar }}
                                        @endif
                                    </option>
                                @endforeach
                            @endif


                        </select>
                    </div>



                    <div class="form-group">
                        <label> {{ __('countries.city_en') }} </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="city_en" />

                    </div>
                    <div class="form-group">
                        <label>{{ __('countries.city_ar') }} </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="city_ar" />

                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('translate.add') }}</button>
                </form>
            </div>
        </div>



        <div class="row bg-white py-3 my-3">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                            <tr>
                                <th>{{ __('countries.country_en') }}</th>
                                <th>{{ __('countries.country_ar') }}</th>
                                <th>{{ __('translate.actions') }}</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($countries as $country)
                            <tr>
                                <!-- Country Information -->
                                <td colspan="2">{{ $country->country_en }} ({{ $country->country_ar }})</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ __('translate.actions') }}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                               onclick="return confirm('Are you sure you want to delete this item?')"
                                               href="{{ route('delete.country', $country->id) }}">{{ __('translate.delete') }}</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        
                            <!-- Cities under the country -->
                            @foreach ($country->cities as $city)
                                <tr>
                                    <!-- City Information -->
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $city->city_en }}</td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $city->city_ar }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ __('translate.actions') }}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" 
                                                onclick="return confirm('Are you sure you want to delete this item?')"
                                                href="{{ route('delete.city', $city->id) }}">{{ __('translate.delete') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        


                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        @include('admin.inc.setting')
    </div>
@endsection
