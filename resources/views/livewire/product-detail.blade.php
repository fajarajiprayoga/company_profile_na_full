<div>
    <div class="nav-overlay-container">
        <livewire:navbar.navbar :transparent="true" />
        @if(!empty($product->wallpaper))
        <div class="background-menu" background="1"
            style="background-image: url('{{asset('storage/'.$product->wallpaper)}}')">
        </div>
        @endif
    </div>
    <div id="specification">

    </div>
    <div class="mx-3 my-14">
            {{-- <div class="flex justify-center my-6 lg:my-12">
                <span class="text-sm font-medium uppercase text-center" style="letter-spacing: 0.5rem;">Saksikan model
                    terbaik kami</span>
            </div> --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 lg:mx-16 gap-4">
            <div class="p-0">
                <div class="text-sm">
                    {!! $product->description !!}
                </div>
                <button disabled
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center text-xs mt-12">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                    </svg>
                    <span>Download Catalog</span>
                </button>
            </div>
            <div class="p-0 bg-yello flex justify-center">
                <div class="p-10 border-none shadow bg-zinc-800 max-w-sm" style="width: 100%">
                    <table class="w-full text-xs text-left rtl:text-right text-gray-500">
                        <tbody>
                            <tr class="border-b text-white">
                                <td class="pb-4 text-left whitespace-nowrap">Brand</td>
                                <td class="pb-4 text-right">{{$product->brand}}</td>
                            </tr>
                            <tr class="border-b text-white">
                                <td class="py-4 text-left whitespace-nowrap">Model</td>
                                <td class="py-4 text-right">{{$product->name}}</td>
                            </tr>
                            <tr class="border-b text-white">
                                <td class="py-4 text-left whitespace-nowrap">Height</td>
                                <td class="py-4 text-right">{{$product->height}}</td>
                            </tr>
                            <tr class="border-b text-white">
                                <td class="py-4 text-left whitespace-nowrap">Width</td>
                                <td class="py-4 text-right">{{$product->width}}</td>
                            </tr>
                            <tr class="border-b text-white">
                                <td class="py-4 text-left whitespace-nowrap">Length</td>
                                <td class="py-4 text-right">{{$product->length}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="detail">

    </div>

    <div class="bg-zinc-700">
        <div class="tabs-header-specification text-white shadow-md shadow-white text-center">
            @if($product->interior)
            <button id="btn-interior" class="tabs-item-specification tabs-item-specification-active text-sm lg:text-base">Interior</button>
            @endif
            @if($product->exterior)
            <button id="btn-exterior" class="tabs-item-specification text-sm lg:text-base">Exterior</button>
            @endif
            @if($product->couches)
            <button id="btn-couches" class="tabs-item-specification text-sm lg:text-base">Couches</button>
            @endif
            @if($product->lighting)
            <button id="btn-lighting" class="tabs-item-specification text-sm lg:text-base">Lighting</button>
            @endif
            @if($product->driver_station)
            <button id="btn-driver_station" class="tabs-item-specification text-sm lg:text-base">Driver's Seat</button>
            @endif
        </div>
        <div class="bg-zinc-800">
            @if($product->interior)
            <div id="tab-interior" class="transition-opacity grid grid-cols-1 lg:grid-cols-2 mx-1 p-3 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->interior !!}
                    </div>
                </div>
                <div class="glide_interior">
                    <div class="overflow-hidden	glide">
                        <div class="glide__track" data-glide-el="track">
                            <div class="glide__slides">
                                @foreach($product->interior_images as $data)
                                <div class="glide__slide">
                                    <img src="{{asset('storage/'.$data)}}" alt="https://newarmada.co.id" srcset="">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="glide__bullets" data-glide-el="controls[nav]">
                            @foreach($product->interior_images as $key => $data)
                                <button class="glide__bullet" data-glide-dir="={{$key}}"></button>
                            @endforeach
                        </div>
                    </div>  
                </div>
            </div>
            @endif
            @if($product->exterior)
            <div id="tab-exterior" class="grid grid-cols-1 lg:grid-cols-2 mx-1 p-3 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->exterior !!}
                    </div>
                </div>
                <div class="glide_exterior">
                    <div class="overflow-hidden	glide">
                        <div class="glide__track" data-glide-el="track">
                            <div class="glide__slides">
                                @foreach($product->exterior_images as $data)
                                <div class="glide__slide">
                                    <img src="{{asset('storage/'.$data)}}" alt="https://newarmada.co.id" srcset="">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="glide__bullets" data-glide-el="controls[nav]">
                            @foreach($product->exterior_images as $key => $data)
                                <button class="glide__bullet" data-glide-dir="={{$key}}"></button>
                            @endforeach
                        </div>
                    </div>  
                </div>
            </div>
            @endif
            @if($product->couches)
            <div id="tab-couches" class="grid grid-cols-1 lg:grid-cols-2 mx-1 p-3 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->couches !!}
                    </div>
                </div>
                <div class="glide_couches">
                    <div class="overflow-hidden	glide">
                        <div class="glide__track" data-glide-el="track">
                            <div class="glide__slides">
                                @foreach($product->couches_images as $data)
                                <div class="glide__slide">
                                    <img src="{{asset('storage/'.$data)}}" alt="https://newarmada.co.id" srcset="">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="glide__bullets" data-glide-el="controls[nav]">
                            @foreach($product->couches_images as $key => $data)
                                <button class="glide__bullet" data-glide-dir="={{$key}}"></button>
                            @endforeach
                        </div>
                    </div>  
                </div>
            </div>
            @endif
            @if($product->lighting)
            <div id="tab-lighting" class="grid grid-cols-1 lg:grid-cols-2 mx-1 p-3 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->lighting !!}
                    </div>
                </div>
                <div class="glide_lighting">
                    <div class="overflow-hidden	glide">
                        <div class="glide__track" data-glide-el="track">
                            <div class="glide__slides">
                                @foreach($product->lighting_images as $data)
                                <div class="glide__slide">
                                    <img src="{{asset('storage/'.$data)}}" alt="https://newarmada.co.id" srcset="">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="glide__bullets" data-glide-el="controls[nav]">
                            @foreach($product->lighting_images as $key => $data)
                                <button class="glide__bullet" data-glide-dir="={{$key}}"></button>
                            @endforeach
                        </div>
                    </div>  
                </div>
            </div>
            @endif
            @if($product->driver_station)
            <div id="tab-driver_station" class="grid grid-cols-1 lg:grid-cols-2 mx-1 p-3 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->driver_station !!}
                    </div>
                </div>
                <div class="glide_driver_station">
                    <div class="overflow-hidden	glide">
                        <div class="glide__track" data-glide-el="track">
                            <div class="glide__slides">
                                @foreach($product->driver_station_images as $data)
                                <div class="glide__slide">
                                    <img src="{{asset('storage/'.$data)}}" alt="https://newarmada.co.id" srcset="">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="glide__bullets" data-glide-el="controls[nav]">
                            @foreach($product->driver_station_images as $key => $data)
                                <button class="glide__bullet" data-glide-dir="={{$key}}"></button>
                            @endforeach
                        </div>
                    </div>  
                </div>
            </div>
            @endif
        </div>
    </div>

    <div id="gallery">

    </div>

    @if(!empty($product->gallery))
    <div class="my-12">
        <div class="flex justify-center my-12">
            <span class="text-sm font-medium uppercase text-center" style="letter-spacing: 0.5rem;">Gallery</span>
        </div>
        <div>
            <div id="gallery-product-wrapper-id" class="gallery-product-wrapper owl-carousel owl-theme cursor-pointer" style="width: 100%">
                @foreach($product->gallery as $data)
                    <div class="item" style="width: 100%; height: 300px;">
                        <img src="{{asset('storage/'.$data)}}" alt="https://newarmada.co.id" srcset="" style="object-fit: cover; height: 100%;">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <div id="video">

    </div>

    @if(!empty($product->video))
    <div class="my-12">
        <div class="flex justify-center my-12">
            <span class="text-sm font-medium uppercase text-center" style="letter-spacing: 0.5rem;">Video</span>
        </div>
        <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
            <iframe  style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="{{'https://youtube.com/embed/'.$product->video}}"></iframe>
        </div>
    </div>
    @endif
    <div class="my-12 mx-2 lg:mx-20">
        <div class="lg:w-1/2 w-full text-sm">
            <p>If you have any questions, need further information, or desire special offers for the <b><i>{{$product->name}}</i></b>, please contact the number provided on the following page under <a class="italic text-blue-700" href="{{route('contact')}}">Contact</a></p>
            <br>
            <p>or view our other products at <a href="{{route('product')}}" class="italic text-blue-700">Produk</a></p>
        </div>
    </div>

    <livewire:footer.footer />
    
    <!-- Bottom Navigation -->
        <div class="fixed bottom-1/2 right-1 bg-transparent z-50">
            <div class="font-medium text-sm">
                <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="focus:ring-4 focus:ring-gray-700 focus:outline-none font-medium rounded-lg text-sm text-center inline-flex items-center" type="button">
                    <svg width="42" height="42" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6 8C6 6.89543 6.89543 6 8 6H14C15.1046 6 16 6.89543 16 8V14C16 15.1046 15.1046 16 14 16H8C6.89543 16 6 15.1046 6 14V8Z" fill="#333333"/> <path d="M6 21C6 19.8954 6.89543 19 8 19H14C15.1046 19 16 19.8954 16 21V27C16 28.1046 15.1046 29 14 29H8C6.89543 29 6 28.1046 6 27V21Z" fill="#333333"/> <path d="M6 34C6 32.8954 6.89543 32 8 32H14C15.1046 32 16 32.8954 16 34V40C16 41.1046 15.1046 42 14 42H8C6.89543 42 6 41.1046 6 40V34Z" fill="#333333"/> <path d="M19 8C19 6.89543 19.8954 6 21 6H27C28.1046 6 29 6.89543 29 8V14C29 15.1046 28.1046 16 27 16H21C19.8954 16 19 15.1046 19 14V8Z" fill="#333333"/> <path d="M19 21C19 19.8954 19.8954 19 21 19H27C28.1046 19 29 19.8954 29 21V27C29 28.1046 28.1046 29 27 29H21C19.8954 29 19 28.1046 19 27V21Z" fill="#333333"/> <path d="M19 34C19 32.8954 19.8954 32 21 32H27C28.1046 32 29 32.8954 29 34V40C29 41.1046 28.1046 42 27 42H21C19.8954 42 19 41.1046 19 40V34Z" fill="#333333"/> <path d="M32 8C32 6.89543 32.8954 6 34 6H40C41.1046 6 42 6.89543 42 8V14C42 15.1046 41.1046 16 40 16H34C32.8954 16 32 15.1046 32 14V8Z" fill="#333333"/> <path d="M32 21C32 19.8954 32.8954 19 34 19H40C41.1046 19 42 19.8954 42 21V27C42 28.1046 41.1046 29 40 29H34C32.8954 29 32 28.1046 32 27V21Z" fill="#333333"/> <path d="M32 34C32 32.8954 32.8954 32 34 32H40C41.1046 32 42 32.8954 42 34V40C42 41.1046 41.1046 42 40 42H34C32.8954 42 32 41.1046 32 40V34Z" fill="#333333"/> </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownHover" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-gray-700 list-none" aria-labelledby="dropdownHoverButton">
                        <li>
                            <a href="#specification" class="block px-4 py-2 hover:bg-gray-100">Specification</a>
                        </li>
                        <li>
                            <a href="#detail" class="block px-4 py-2 hover:bg-gray-100">Detail</a>
                        </li>
                        @if(!empty($product->gallery))
                        <li>
                            <a href="#gallery" class="block px-4 py-2 hover:bg-gray-100">Gallery</a>
                        </li>
                        @endif
                        @if(!empty($product->video))
                        <li>
                            <a href="#video" class="block px-4 py-2 hover:bg-gray-100">Video</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    <!-- Bottom Navigation -->

</div>

@script
<script>
    $(document).ready(function() {     
        /**
         * 1. Tab pertama dimunculkan, tab lain di hide. Lalu ketika klik button baru tab muncul
         * 2. .mount() slider glide_interior saat pertama kali load. Yang lain di mount setelah klik button
         * */                           
        $('#tab-interior').removeClass('hidden');
        new Glide('.glide_interior .glide').mount();
        $('#tab-exterior').addClass('hidden');
        $('#tab-couches').addClass('hidden');
        $('#tab-lighting').addClass('hidden');
        $('#tab-driver_station').addClass('hidden');

        $(window).on('load', function() {
            $('#btn-interior').on('click', function(){
                $('#tab-interior').removeClass('hidden');
                $('#tab-exterior').addClass('hidden');
                $('#tab-couches').addClass('hidden');
                $('#tab-lighting').addClass('hidden');
                $('#tab-driver_station').addClass('hidden');

                $(this).addClass('tabs-item-specification-active');

                $('#btn-exterior').removeClass('tabs-item-specification-active');
                $('#btn-couches').removeClass('tabs-item-specification-active');
                $('#btn-lighting').removeClass('tabs-item-specification-active');
                $('#btn-driver_station').removeClass('tabs-item-specification-active');

                new Glide('.glide_interior .glide').mount();
            });
            $('#btn-exterior').on('click', function(){
                $('#tab-exterior').removeClass('hidden');
                $('#tab-interior').addClass('hidden');
                $('#tab-couches').addClass('hidden');
                $('#tab-lighting').addClass('hidden');
                $('#tab-driver_station').addClass('hidden');

                $(this).addClass('tabs-item-specification-active');

                $('#btn-interior').removeClass('tabs-item-specification-active');
                $('#btn-couches').removeClass('tabs-item-specification-active');
                $('#btn-lighting').removeClass('tabs-item-specification-active');
                $('#btn-driver_station').removeClass('tabs-item-specification-active');

                new Glide('.glide_exterior .glide').mount();
            });
            $('#btn-couches').on('click', function(){
                $('#tab-couches').removeClass('hidden');
                $('#tab-exterior').addClass('hidden');
                $('#tab-interior').addClass('hidden');
                $('#tab-lighting').addClass('hidden');
                $('#tab-driver_station').addClass('hidden');

                $(this).addClass('tabs-item-specification-active');

                $('#btn-exterior').removeClass('tabs-item-specification-active');
                $('#btn-interior').removeClass('tabs-item-specification-active');
                $('#btn-lighting').removeClass('tabs-item-specification-active');
                $('#btn-driver_station').removeClass('tabs-item-specification-active');

                new Glide('.glide_couches .glide').mount();
            });
            $('#btn-lighting').on('click', function(){
                $('#tab-lighting').removeClass('hidden');
                $('#tab-couches').addClass('hidden');
                $('#tab-exterior').addClass('hidden');
                $('#tab-interior').addClass('hidden');
                $('#tab-driver_station').addClass('hidden');

                $(this).addClass('tabs-item-specification-active');

                $('#btn-couches').removeClass('tabs-item-specification-active');
                $('#btn-exterior').removeClass('tabs-item-specification-active');
                $('#btn-interior').removeClass('tabs-item-specification-active');
                $('#btn-driver_station').removeClass('tabs-item-specification-active');

                new Glide('.glide_lighting .glide').mount();
            });
            $('#btn-driver_station').on('click', function(){
                $('#tab-driver_station').removeClass('hidden');
                $('#tab-lighting').addClass('hidden');
                $('#tab-couches').addClass('hidden');
                $('#tab-exterior').addClass('hidden');
                $('#tab-interior').addClass('hidden');

                $(this).addClass('tabs-item-specification-active');

                $('#btn-lighting').removeClass('tabs-item-specification-active');
                $('#btn-couches').removeClass('tabs-item-specification-active');
                $('#btn-exterior').removeClass('tabs-item-specification-active');
                $('#btn-interior').removeClass('tabs-item-specification-active');

                new Glide('.glide_driver_station .glide').mount();
            });
        })
    })
</script>
@endscript