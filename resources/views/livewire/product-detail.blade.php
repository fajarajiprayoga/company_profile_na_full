<div>
    <div class="nav-overlay-container">
        <livewire:navbar.navbar :transparent="true" />
        @if(!empty($product->wallpaper))
        <div class="background-menu" background="1"
            style="background-image: url('{{asset('storage/'.$product->wallpaper)}}')">
        </div>
        @endif
    </div>
    <div class="mx-5 my-14">
            <div class="flex justify-center my-12">
                <span class="text-sm font-medium uppercase text-center" style="letter-spacing: 0.5rem;">Saksikan model
                    terbaik kami</span>
            </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 lg:mx-16 gap-4">
            <div class="p-5">
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
            <div class="p-5 bg-yello flex justify-center">
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

    <div class="bg-zinc-700">
        <div class="tabs-header-specification text-white shadow-md shadow-white text-center">
            @if($product->interior)
            <button id="btn-interior" class="tabs-item-specification tabs-item-specification-active">Interior</button>
            @endif
            @if($product->exterior)
            <button id="btn-exterior" class="tabs-item-specification">Exterior</button>
            @endif
            @if($product->couches)
            <button id="btn-couches" class="tabs-item-specification">Bangku</button>
            @endif
            @if($product->lighting)
            <button id="btn-lighting" class="tabs-item-specification">Lampu</button>
            @endif
            @if($product->driver_station)
            <button id="btn-driver_station" class="tabs-item-specification">Bangku Pengemudi</button>
            @endif
        </div>
        <div class="bg-zinc-800">
            @if($product->interior)
            <div id="tab-interior" class="transition-opacity grid grid-cols-1 lg:grid-cols-2 mx-1 p-5 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->interior !!}
                    </div>
                </div>
                <div style="max-height: 400px; min-width: 100%">
                    <div id="" class="interior_slider owl-carousel owl-theme cursor-pointer" style="width: 100%">
                        @foreach($product->interior_images as $data)
                            <div class="item" style="width: 100%; height: 100%;">
                                <img src="{{asset('storage/'.$data)}}" alt="https://newarmada.co.id" srcset="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            @if($product->exterior)
            <div id="tab-exterior" class="grid grid-cols-1 lg:grid-cols-2 mx-1 p-5 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->exterior !!}
                    </div>
                </div>
                <div style="max-height: 400px; min-width: 100%">
                    <div id="" class="exterior_slider owl-carousel owl-theme cursor-pointer" style="width: 100%">
                        @foreach($product->exterior_images as $data)
                            <div class="item" style="width: 100%; height: 100%;">
                                <img src="{{asset('storage/'.$data)}}" alt="https://newarmada.co.id" srcset="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            @if($product->couches)
            <div id="tab-couches" class="grid grid-cols-1 lg:grid-cols-2 mx-1 p-5 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->couches !!}
                    </div>
                </div>
                <div style="max-height: 400px; min-width: 100%">
                    <!-- <img src="{{asset('storage/'.$product->couches_images[0])}}" alt="" srcset="" style="height: 100%; width: 100%"> -->
                    <div id="" class="couches_slider owl-carousel owl-theme cursor-pointer" style="width: 100%">
                        @foreach($product->couches_images as $data)
                            <div class="item" style="width: 100%; height: 100%;">
                                <img src="{{asset('storage/'.$data)}}" alt="https://newarmada.co.id" srcset="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            @if($product->lighting)
            <div id="tab-lighting" class="grid grid-cols-1 lg:grid-cols-2 mx-1 p-5 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->lighting !!}
                    </div>
                </div>
                <div style="max-height: 400px; min-width: 100%">
                    <!-- <img src="{{asset('storage/'.$product->lighting_images[0])}}" alt="" srcset="" style="height: 100%; width: 100%"> -->
                    <div id="" class="lighting_slider owl-carousel owl-theme cursor-pointer" style="width: 100%">
                        @foreach($product->lighting_images as $data)
                            <div class="item" style="width: 100%; height: 100%;">
                                <img src="{{asset('storage/'.$data)}}" alt="https://newarmada.co.id" srcset="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            @if($product->driver_station)
            <div id="tab-driver_station" class="grid grid-cols-1 lg:grid-cols-2 mx-1 p-5 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->driver_station !!}
                    </div>
                </div>
                <div style="max-height: 400px; min-width: 100%">
                    <!-- <img src="{{asset('storage/'.$product->driver_station_images[0])}}" alt="" srcset="" style="height: 100%; width: 100%"> -->
                    <div id="" class="driver_station_slider owl-carousel owl-theme cursor-pointer" style="width: 100%">
                        @foreach($product->driver_station_images as $data)
                            <div class="item" style="width: 100%; height: 100%;">
                                <img src="{{asset('storage/'.$data)}}" alt="https://newarmada.co.id" srcset="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
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
    <div>
    </div>
    <livewire:footer.footer />
</div>

@script
<script>
    $(document).ready(function() {
        $('.interior_slider').owlCarousel({
                loop:true,
                mouseDrag:true,
                autoplay:false,
                nav: true,
                navText : ["<span style='font-size: 36px;color: #FFF;opacity: 0.4;'><</span>","<span style='font-size: 36px;color: #FFF;opacity: 0.4;'>></span>"],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:1
                    }
                },
                onInitialized: function() {
                
                }
            });

            $('.exterior_slider').owlCarousel({
                loop:true,
                mouseDrag:true,
                autoplay:false,
                nav: true,
                navText : ["<span style='font-size: 36px;color: #FFF;opacity: 0.4;'><</span>","<span style='font-size: 36px;color: #FFF;opacity: 0.4;'>></span>"],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:1
                    }
                },
                onInitialized: function() {
                    $('#tab-exterior').addClass('hidden');
                }
            });
            $('.couches_slider').owlCarousel({
                loop:true,
                mouseDrag:true,
                autoplay:false,
                nav: true,
                navText : ["<span style='font-size: 36px;color: #FFF;opacity: 0.4;'><</span>","<span style='font-size: 36px;color: #FFF;opacity: 0.4;'>></span>"],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:1
                    }
                },
                onInitialized: function() {
                    $('#tab-couches').addClass('hidden');
                }
            });
            $('.lighting_slider').owlCarousel({
                loop:true,
                mouseDrag:true,
                autoplay:false,
                nav: true,
                navText : ["<span style='font-size: 36px;color: #FFF;opacity: 0.4;'><</span>","<span style='font-size: 36px;color: #FFF;opacity: 0.4;'>></span>"],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:1
                    }
                },
                onInitialized: function() {
                    $('#tab-lighting').addClass('hidden');
                }
            });
            $('.driver_station_slider').owlCarousel({
                loop:true,
                mouseDrag:true,
                autoplay:false,
                nav: true,
                navText : ["<span style='font-size: 36px;color: #FFF;opacity: 0.4;'><</span>","<span style='font-size: 36px;color: #FFF;opacity: 0.4;'>></span>"],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:1
                    }
                },
                onInitialized: function() {
                    $('#tab-driver_station').addClass('hidden');
                }
            });
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
            });
        })
    })
</script>
@endscript