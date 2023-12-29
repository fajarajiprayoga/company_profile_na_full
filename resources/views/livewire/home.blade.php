<div>
    <div class="nav-overlay-container">
        <x-navigation.navbar />
        <div class="nav-overlay-carousel owl-carousel">
            @foreach($sliders as $slider)
            @if($slider['ext'] == 'mp4')
            <div class="item">
                <video class="sm:hidden" style="width: 100%; height: auto;" autoplay muted loop>
                    <source src="{{asset('storage/'.$slider['file_name'])}}" type="video/mp4">
                </video>
            </div>
            @else
            <div class="item" style="background-image: url('{{asset('storage/'.$slider['file_name'])}}')"></div>
            @endif
            @endforeach
        </div>
    </div>
    <div style="width: 100%; height: 400px; background-image: url('{{asset('sliders/barcode.jpg')}}');">
    </div>
</div>
