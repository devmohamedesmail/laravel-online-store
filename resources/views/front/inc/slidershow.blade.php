<div class="slideshow-container relative m-auto w-full">
    
    @foreach ($sliders as $slider)
        <div class="mySlides hidden fade">
            <img src="{{ asset('/uploads/' . $slider->image) }}" style="width:100%"> 
        </div>
    @endforeach


</div>

