<div>
    <div class="nav-overlay-container">
        <x-navigation.navbar />
        <div class="nav-overlay-carousel owl-carousel" id="carousel">
            @foreach($sliders as $slider)
            @if($slider['ext'] == 'mp4')
            <div class="item">
                <video class="carousel-video" autoplay muted loop>
                    <source src="{{asset('storage/'.$slider['file_name'])}}" type="video/mp4">
                </video>
                @if(!empty($slider['title']))
                <div class="carousel-text text-center">
                    {{$slider['title']}}
                </div>
                @endif
            </div>
            @else
            <div class="item" style="background-image: url('{{asset('storage/'.$slider['file_name'])}}')">
                @if(!empty($slider['title']))
                <div class="carousel-text text-center">
                    {{$slider['title']}}
                </div>
                @endif
            </div>
            @endif
            @endforeach
        </div>
    </div>
    <div id="home-model-wrapper">
        <div class="section-title">
            Model
        </div>
        <div id="product-carousel" class="owl-carousel">
            @foreach($show_in_home_products as $show_in_home_product)
            <div class="item" style="width: 100%; height: auto;">
                <div class="product_carousel_wrapper">
                    <img class="img-product-carousel" style="" src="{{asset('storage/'.$show_in_home_product['images'])}}" alt="https://newarmada.co.id"
                        srcset="">
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 text-white">
                    <div style="font-size: 36px; font-weight: 600;">{{$show_in_home_product->name}}</div>
                    <div class="product_carousel_descriptions" style="font-size: 12px; font-weight: 400;">{!!
                        $show_in_home_product->description !!}</div>
                    <div class="common-button-wrap">
                        <a href="" class="common-button">
                            <span>
                                Detail
                            </span>
                            <svg width="22" height="21" viewBox="0 0 22 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.875 10.5H17.125" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M11 4.375L17.125 10.5L11 16.625" stroke="black" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div style="margin-top: 12px; width: 100%; height: 2px; background-color: white;"></div>
            </div>
            @endforeach
        </div>
    </div>
    <div id="home-gallery-wrapper">
        <div class="flex justify-between" style="margin-bottom: 1rem;">
            <div style="font-weight: 600; font-size: 22px;">Gallery</div>
            <div style="font-size: 22px;"><span>Follow IG : </span>@newarmada</div>
        </div>
    </div>
</div>