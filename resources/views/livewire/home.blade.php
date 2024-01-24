<div>
    <div class="nav-overlay-container">
        <livewire:navbar.navbar :transparent="true"/>
        <div class="nav-overlay-carousel owl-carousel" id="carousel">
            @foreach($sliders as $slider)
            @if($slider['ext'] == 'mp4')
            <div class="item">
                <video class="carousel-video" autoplay muted loop style="object-fit: cover;">
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
                <div class="product_carousel_wrapper" style="width: 100%;">
                    <img class="img-product-carousel my-5 lg:my-12" style="width: 80%;"
                        src="{{asset('storage/'.$show_in_home_product['home_photo'])}}" alt="https://newarmada.co.id"
                        srcset="">
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 text-white">
                    <div style="" class="text-2xl lg:text-3xl font-semibold text-center common-button-wrap">
                        {{$show_in_home_product->name}}
                    </div>
                    <div class="product_carousel_descriptions" style="font-size: 14px; font-weight: 400;">{!!
                        $show_in_home_product->description !!}</div>
                    <div class="common-button-wrap text-xs lg:text-md">
                        <a href="{{route('product-detail', $show_in_home_product->slug)}}" class="common-button">
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
                <div class="line-trough" style="margin-top: 12px; width: 100%; height: 2px; background-color: white;"></div>
            </div>
            @endforeach
        </div>
    </div>
    <livewire:gallery />
    <div>
        <div class="section-title mb-12" style="color: black;">
            Plant
        </div>
        <div id="map" style="height: 500px"></div>
    </div>
    <livewire:footer.footer />

    @push('scripts')
        <script>
            var map = L.map('map').setView([-7.2682762396014455, 109.80371518530026], 7);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            //Marker
            var marker = []
            @foreach($maps as $map)

                var arr_temp = [{{$map->longitude}}, {{$map->latitude}} , '{{$map->title}}', '{{$map->gmaps_url}}']
                marker.push(arr_temp);

            @endforeach
                
            marker.forEach(function(e) {
                L.marker([e[0], e[1]]).addTo(map).bindPopup(
                    "<div><strong>"+e[2]+"</strong></div>"+
                    "<div style='text-align: center'><a target='_blank' href='"+e[3]+"'>Visit</a></div>"
                    );
            });
        </script>
    @endpush
</div>