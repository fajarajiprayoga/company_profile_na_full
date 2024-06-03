<div>
    <div class="nav-overlay-container">
        <livewire:navbar.navbar :transparent="true"/>
        <div class="nav-overlay-carousel owl-carousel" id="carousel">
            @foreach($sliders as $slider)
            @if($slider['ext'] == 'mp4')
            <div class="item">
                <video class="carousel-video" playsinline autoplay muted loop style="object-fit: cover;">
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
        <div class="section-title mb-12">
            Model
        </div>       
        <div class="glide_home_model bg-red-00">
            <div class="glide">
                <div class="glide__track" data-glide-el="track">
                    <div class="glide__slides">
                        @foreach($show_in_home_products as $show_in_home_product)
                            <div class="glide__slide">
                                <div class="flex justify-center">
                                    <img class="w-full lg:w-5/6" style=""
                                        src="{{asset('storage/'.$show_in_home_product['home_photo'])}}" alt="https://newarmada.co.id"
                                        srcset="">
                                </div>
                                <div class="hidden lg:block">
                                    <div class="grid grid-cols-1 lg:grid-cols-3 text-white mt-5">
                                        <div style="" class="text-2xl lg:text-3xl font-semibold text-center common-button-wrap">
                                            {{$show_in_home_product->name}}
                                        </div>
                                        <div class="product_carousel_descriptions" style="font-size: 14px; font-weight: 400;">{!!
                                            $show_in_home_product->description !!}</div>
                                        <div class="common-button-wrap text-xs lg:text-md">
                                            <a href="{{route('product-detail', $show_in_home_product->slug)}}" class="border border-none bg-white rounded-lg transition duration-200 ease-in-out cursor-pointer mx-auto flex items-center justify-center w-60  text-black text-sm border border-none  h-12 text-black text-base">
                                                <span style="margin-top: 2px;">
                                                    Detail
                                                </span>
                                                <svg width="18" height="17" viewBox="0 0 22 21" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.875 10.5H17.125" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path d="M11 4.375L17.125 10.5L11 16.625" stroke="black" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="block lg:hidden">
                                    <div class="mt-3">
                                        <div style="" class="text-xl font-semibold text-white text-center common-button-wrap">
                                            {{$show_in_home_product->name}}
                                        </div>
                                        <div class="text-center">
                                            <a href="{{route('product-detail', $show_in_home_product->slug)}}" class="inline-flex items-center font-medium text-white hover:text-blue-800 text-xs">
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="line-trough" style="margin-top: 12px; width: 100%; height: 2px; background-color: white;"></div>
                            </div>
                        @endforeach
                    </div>
                    <div class="glide__arrows hidden lg:block" data-glide-el="controls">
                        <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><</button>
                        <button class="glide__arrow glide__arrow--right" data-glide-dir=">">></button>
                    </div>
                    <div class="flex justify-center">
                        <div class="block lg:hidden" data-glide-el="controls">
                            <button class="text-gray-900 bg-white border border-gray-300 font-medium  text-xs px-1 py-0" data-glide-dir="<"><</button>
                            <button class="text-gray-900 bg-white border border-gray-300 font-medium  text-xs px-1 py-0" data-glide-dir=">">></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="mx-o lg:mx-12">
        <div class="text-center mt-8 lg:my-12 mb-3 lg:mb-5">
            <span class="font-bold text-xl lg:text-3xl tracking-widest text-primary-800">Product</span>
            <br>
            <span class="text-base lg:text-lg">Customer satisfaction is our commitment.</span>
        </div> --}}
        {{-- Product Dekstop --}}
        {{-- <div class="glide_product_dekstop hidden lg:block">
            <div class="glide">
                <div class="glide__track" data-glide-el="track">
                    <div class="glide__slides" style="height: 80vh">
                        @foreach ($types->chunk(3) as $key => $chunk)
                            <div class="glide__slide">
                                <div class="flex h-full justify-center">
                                    @foreach ($chunk as $data)
                                        <div wire:click="type({{$data->id}})" class="relative h-full w-96 hover:w-full transition-all duration-500 ease-in-out cursor-pointer">
                                            <img class="absolute h-full object-cover duration-500 brightness-[0.65] hover:brightness-100" src="{{!empty($data->img) ? asset('storage/'.$data->img) : asset('assets/product/product-1.jpg')}}" alt="" srcset="">
                                            <span class="absolute px-3 py-1 text-white bottom-6 bg-slate-400 rounded-r-lg"><p class="text-base lg:text-xl font-bold">{{$data->name}}</p></span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-center mt-2">
                    <div class="" data-glide-el="controls">
                        <button type="button" data-glide-dir="<" class="bg-gray-800 text-white rounded-l-md border-r border-gray-100 py-2 hover:bg-red-700 hover:text-white px-3">
                            <div class="flex flex-row align-middle">
                            <svg class="w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                            </svg>
                            </div>
                        </button>
                        <button type="button" data-glide-dir=">" class="bg-gray-800 text-white rounded-r-md py-2 border-l border-gray-200 hover:bg-red-700 hover:text-white px-3">
                            <div class="flex flex-row align-middle">
                            <svg class="w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- Product Dekstop --}}
        {{-- Product Mobile --}}
        {{-- <div class="glide_product_mobile block lg:hidden">
            <div class="glide">
                <div class="glide__track" data-glide-el="track">
                    <div class="glide__slides" style="height: 80vh">
                        @foreach ($types->chunk(2) as $key => $chunk)
                            <div class="glide__slide">
                                <div class="flex h-full justify-center">
                                    @foreach ($chunk as $data)
                                        <div wire:click="type({{$data->id}})" class="relative h-full w-96 hover:w-full transition-all duration-500 ease-in-out cursor-pointer">
                                            <img class="absolute h-full object-cover duration-500 brightness-[0.65] hover:brightness-100" src="{{!empty($data->img) ? asset('storage/'.$data->img) : asset('assets/product/product-1.jpg')}}" alt="" srcset="">
                                            <span class="absolute px-3 py-1 text-white bottom-6 bg-slate-400 rounded-r-lg"><p class="text-base lg:text-xl font-bold">{{$data->name}}</p></span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if (count($types) > 2)                
                <div class="flex justify-end mt-2 mr-2">
                    <div class="" data-glide-el="controls">
                        <button type="button" data-glide-dir="<" class="bg-gray-800 text-white rounded-l-md border-r border-gray-100 py-2 hover:bg-red-700 hover:text-white px-3">
                            <div class="flex flex-row align-middle">
                            <svg class="w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                            </svg>
                            </div>
                        </button>
                        <button type="button" data-glide-dir=">" class="bg-gray-800 text-white rounded-r-md py-2 border-l border-gray-200 hover:bg-red-700 hover:text-white px-3">
                            <div class="flex flex-row align-middle">
                            <svg class="w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            </div>
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div> --}}
        {{-- Product Mobile --}}
    {{-- </div> --}}

    <livewire:gallery />
    {{-- Stamping Web --}}
    @if (!empty($about_stamping) && !empty($stampingProductTypes))
    <div style="background: #f3f4f5" class="py-12">
        <div class="text-center">
            <span class="font-bold text-xl lg:text-3xl tracking-widest text-primary-800">Bisnis Unit</span>
            <br>
            <span class="text-base lg:text-lg">Company specializing in the Bodywork field since 1974.</span>
        </div>
        <div class="lg:mx-48 mt-5 rounded-lg lg:grid lg:grid-cols-2 lg:gap-5">
            <div class="text-center lg:text-right my-0 lg:flex lg:items-center" data-aos="fade-right" data-aos-duration="1000">
                <div>
                    <div class="my-2 lg:my-5">
                        <span class="font-bold text-xl lg:text-3xl">{{!empty($about_stamping) ? $about_stamping['about_title'] : ''}}</span>
                    </div>
                    <div class="font-medium text-sm lg:text-base mx-3 lg:mx-0">
                        {{!empty($about_stamping) ? $about_stamping['about_description'] : ''}}
                    </div>
                    <div class="flex justify-center items-center lg:justify-end mt-2 lg:mt-5 mb-3 lg:mb-0 bg-red-yellow">
                        <a href="https://stamping.newarmada.co.id" target="_blank" class="focus:outline-none text-white bg-primary-700 hover:bg-primary-600 focus:ring-4 focus:ring-primary-300 flex font-medium rounded-lg w-26 text-sm px-3 py-2 lg:px-5 lg:py-2.5 me-2 text-center">
                            Visit Website
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <video class="w-full h-auto" playsinline autoplay muted loop controls>
                    <source src="https://newarmada.co.id/assets/stamping/Company Profile_Stamping & Tools Division.mp4" type="video/mp4">
                </video>
            </div>
        </div>

        <div class="lg:mx-48 mx-3">
            <div class="text-center mt-8 mb-3 lg:mb-5">
                <span class="font-bold text-lg lg:text-2xl tracking-widest text-primary-800">Product and Services</span>
                <br>
                <span class="text-base lg:text-lg">{{!empty($about_stamping) ? $about_stamping['about_title'] : ""}}</span>
            </div>
            <div class="md:grid md:grid-cols-3 md:gap-5">
                @foreach ($stampingProductTypes as $type)
                @if (count($type['products']) > 0)
                    <a target="_blank" href="https://stamping.newarmada.co.id/product/{{$type['slug'] .'/'. $type['products'][0]['slug']."#product-tab"}}">
                        <figure class="relative max-w-sm mb-3 transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
                            <img class="rounded-lg" src="https://stamping.newarmada.co.id/storage/{{$type['image']}}" alt="{{$type['name']}}" styly="">
                            <figcaption class="absolute px-3 py-1 text-lg lg:text-xl font-bold text-white bg-slate-00 bottom-6 rounded-r-lg">
                                <p class="uppercase">{{$type['name']}}</p>
                            </figcaption>
                        </figure>
                    </a>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif
    {{-- Stamping Web --}}

    {{-- News --}}
    @if(count($latest_news) > 0)
<div class="lg:mx-48 mx-3">
    <div class="text-center mt-8 mb-5 flex justify-between justify-center items-center">
        <span class="font-bold text-xl lg:text-2xl tracking-widest text-primary-800">Latest News</span>
        <br>
        <a href="{{route('news')}}" class="bg-gray-800 text-sm text-white rounded-md border-r border-gray-100 py-1 hover:bg-red-700 hover:text-white px-2">
            <div class="flex items-center py-1 px-3">
                <span>See Other</span>
            </div>
        </a>
    </div>
    {{-- News Dekstop --}}
    <div class="lg:grid lg:grid-cols-3 lg:gap-2 hidden lg:block">
        @foreach ($latest_news as $data)
        <div class="relative bg-white border border-gray-200 rounded-lg shadow mb-3 lg:mb-0"  style="min-height: 400px;">
            <div class="relative overflow-hidden">
                <a href="{{ route('news-detail', $data->slug) }}">
                    <img class="rounded-t-lg transition-transform transform duration-500 hover:scale-110" src="{{asset('storage/'.$data['thumbnail'])}}" alt="" />
                </a>
            </div>
            <div class="p-5">
                <div>
                    <span class="text-sm text-gray-500">
                        {{ strftime('%a, %e %b %Y', strtotime($data->news_date)) }}
                    </span>
                    <span class="text-sm text-gray-500">|</span>
                    <span class="text-sm text-gray-500">{{$data->category->title}}</span>
                </div>
                <a href="{{ route('news-detail', $data->slug) }}">
                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900">{{ Str::limit($data->title, 63, "...") }}</h5>
                </a>
                <div class="absolute bottom-3 left-3">
                    <a href="{{ route('news-detail', $data->slug) }}" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-blue-600 hover:underline">
                        Read more
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{-- News Dekstop --}}

    {{-- News Mobile --}}
    <div class="glide_news">
        <div class="glide block lg:hidden">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    @foreach($latest_news as $data)
                        <li class="glide__slide">
                            <div class="relative bg-white border border-gray-200 rounded-lg shadow mb-3 lg:mb-0"  style="min-height: 400px;">
                                <div class="relative overflow-hidden">
                                    <a href="{{ route('news-detail', $data->slug) }}">
                                        <img class="rounded-t-lg transition-transform transform hover:scale-110" src="{{asset('storage/'.$data['thumbnail'])}}" alt="" />
                                    </a>
                                </div>
                                <div class="p-5">
                                    <div>
                                        <span class="text-sm text-gray-500">
                                            {{ strftime('%a, %e %b %Y', strtotime($data->news_date)) }}
                                        </span>
                                        <span class="text-sm text-gray-500">|</span>
                                        <span class="text-sm text-gray-500">{{$data->category->title}}</span>
                                    </div>
                                    <a href="{{ route('news-detail', $data->slug) }}">
                                        <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900">{{ Str::limit($data->title, 63, "...") }}</h5>
                                    </a>
                                    <div class="absolute bottom-3 left-3">
                                        <a href="{{ route('news-detail', $data->slug) }}" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-blue-600 hover:underline">
                                            Read more
                                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                </div>
                @if(count($latest_news) > 1)
                <div class="flex justify-end">
                    <div class="" data-glide-el="controls">
                        <button type="button" data-glide-dir="<" class="bg-gray-800 text-white rounded-l-md border-r border-gray-100 py-2 hover:bg-red-700 hover:text-white px-3">
                            <div class="flex flex-row align-middle">
                            <svg class="w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                            </svg>
                            </div>
                        </button>
                        <button type="button" data-glide-dir=">" class="bg-gray-800 text-white rounded-r-md py-2 border-l border-gray-200 hover:bg-red-700 hover:text-white px-3">
                            <div class="flex flex-row align-middle">
                            <svg class="w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            </div>
                        </button>
                    </div>
                </div>
                @endif
            </div>
            {{-- News Mobile --}}
        </div>
    </div>
    {{-- News --}}
    @endif
    
    <div>
        <div class="section-title my-12 text-2xl" style="color: black;">
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

            var glide_home_model = new Glide('.glide_home_model .glide', {
                type: 'slider',
                autoplay: 3000|true
            }).mount()

            var glide_news_parent = document.querySelector(".glide_news");
            if(glide_news_parent != null){
                var glide_news = new Glide('.glide_news .glide', {
                    type: 'slider',
                }).mount()
            }

            // var glide_product_dekstop = new Glide('.glide_product_dekstop .glide', {
            //     type: 'slider',
            // }).mount()

            // var glide_product_mobile = new Glide('.glide_product_mobile .glide', {
            //     type: 'slider',
            // }).mount()


        </script>
    @endpush
</div>