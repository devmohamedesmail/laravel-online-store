@extends('admin.layout')

@section('content')
    <div class="main-content">
        <div class="media-library-container">
            <!-- Display media files -->
            <div class="media-files d-flex justify-content-start flex-wrap">
                @foreach ($images as $image)
                    <div class="media-item bg-white m-2 p-3">
                        <img src="{{ asset('uploads/' . $image->getFilename()) }}" alt="{{ $image->getFilename() }}"
                            style="width:150px; ">
                        {{-- <p>{{ $image->getFilename() }}</p> --}}
                    </div>
                @endforeach
            </div>

        </div>
        @include('admin.inc.setting')
    </div>
@endsection
