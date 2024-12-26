


<div class="slideshow slideshow-wrapper pb-section">
    <div class="home-slideshow">

      


        @if (count($sliders) > 0)
            @foreach ($sliders as $slider )
            <div class="slide">
                <div class="blur-up lazyload">
                    <img class="blur-up lazyload" data-src="{{ asset('/uploads/' . $slider->image) }}" src="{{ asset('/uploads/' . $slider->image) }}" alt="{{ $slider->title }}" title="{{ $slider->title }}" />
                    <div class="slideshow__text-wrap slideshow__overlay classic middle">
                        <div class="slideshow__text-content middle">
                            <div class="container">
                                <div class="wrap-caption right">
                                    <h2 class="h1 mega-title slideshow__title">{{ $slider->title  }}</h2>
                                    <span class="mega-subtitle slideshow__subtitle">{{ $slider->description  }}</span>
                                    {{-- <span class="btn">Shop now</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            @endforeach
        @else
            
        @endif
      
    </div>
</div>