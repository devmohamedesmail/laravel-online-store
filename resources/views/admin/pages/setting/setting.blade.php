@extends('admin.layout')

@section('content')
    <div class="main-content">
        <section class="section">
            <h6>{{ __('translate.setting') }}</h6>
            <div>
                <form action="{{ route('update.setting') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label> {{ __('translate.name_en') }} </label>
                                <input type="text" class="form-control" name="name_en" value="{{ $setting->name_en }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label> {{ __('translate.name_ar') }} </label>
                                <input type="text" class="form-control" name="name_ar" value="{{ $setting->name_ar }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label> {{ __('translate.description') }} </label>

                                <textarea type="text" class="form-control" name="description">
                                    {{ $setting->description }}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>{{ __('translate.phone') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="phone" value="{{ $setting->phone }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>{{ __('translate.email') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="far fa-envelope"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ $setting->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">

                            <div class="form-group">
                                <label>{{ __('translate.address') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ $setting->address }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>{{ __('translate.facebook') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fab fa-facebook"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="facebook"
                                        value="{{ $setting->facebook }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>{{ __('translate.instgram') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fab fa-instagram"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="instagram"
                                        value="{{ $setting->instagram }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>{{ __('translate.twitter') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fab fa-twitter"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="twitter"
                                        value="{{ $setting->twitter }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>{{ __('translate.linkedin') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fab fa-linkedin-in"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="linkedin"
                                        value="{{ $setting->linkedin }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">

                            <div class="form-group">
                                <label>{{ __('translate.youtube') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fab fa-youtube"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="youtube"
                                        value="{{ $setting->youtube }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">

                            <div class="form-group">
                                <label> {{ __('translate.whatsapp') }} </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fab fa-whatsapp"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="whatsapp"
                                        value="{{ $setting->whatsapp }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">

                            <div class="form-group">
                                <label> {{ __('translate.appurl') }} </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-link"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="appurl"
                                        value="{{ $setting->appurl }}">
                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-md-6">
                            @if (!$setting->logo)
                                <p class="text-center font-weight-bold"> {{ __('translate.no-image') }}</p>
                            @else
                                <img src="/uploads/setting/{{ $setting->logo }}" width="50px" alt="{{ $setting->description }}">
                            @endif

                            
                            <div class="custom-file mt-3">
                                <input type="file" class="custom-file-input" id="customFile" name="logo">
                                <label class="custom-file-label" for="customFile">{{ __('translate.choose-image') }}</label>
                            </div>
                        </div>


                    </div>



                    <button class="btn btn-primary" type="submit">{{ __('translate.update') }}</button>

                </form>
            </div>
        </section>
        @include('admin.inc.setting')
    </div>
@endsection
