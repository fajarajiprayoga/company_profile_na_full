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
            <button class="{{ $tabDetail == 'interior' ? 'tabs-item-specification-active' : 'tabs-item-specification' }}" wire:click="tab('interior')">Interior</button>
            @endif
            @if($product->exterior)
            <button class="{{ $tabDetail == 'exterior' ? 'tabs-item-specification-active' : 'tabs-item-specification' }}" wire:click="tab('exterior')">Exterior</button>
            @endif
            @if($product->couches)
            <button class="{{ $tabDetail == 'couches' ? 'tabs-item-specification-active' : 'tabs-item-specification' }}" wire:click="tab('couches')">Bangku</button>
            @endif
            @if($product->lighting)
            <button class="{{ $tabDetail == 'lighting' ? 'tabs-item-specification-active' : 'tabs-item-specification' }}" wire:click="tab('lighting')">Lampu</button>
            @endif
            @if($product->driver_station)
            <button class="{{ $tabDetail == 'driver_station' ? 'tabs-item-specification-active' : 'tabs-item-specification' }}" wire:click="tab('driver_station')">Bangku Pengemudi</button>
            @endif
        </div>
        <div class="bg-zinc-800">
            @if($product->interior)
            <div class="{{ $tabDetail == 'interior' ? '' : 'hidden' }} transition-opacity grid grid-cols-1 lg:grid-cols-2 mx-1 p-5 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->interior !!}
                    </div>
                </div>
                <div style="max-height: 400px; min-width: 100%">
                    <img src="{{asset('storage/'.$product->interior_images)}}" alt="" srcset="" style="height: 100%; width: 100%">
                </div>
            </div>
            @endif
            @if($product->exterior)
            <div class="{{ $tabDetail == 'exterior' ? '' : 'hidden' }} grid grid-cols-1 lg:grid-cols-2 mx-1 p-5 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->exterior !!}
                    </div>
                </div>
                <div style="max-height: 400px; min-width: 100%">
                    <img src="{{asset('storage/'.$product->exterior_images)}}" alt="" srcset="" style="height: 100%; width: 100%">
                </div>
            </div>
            @endif
            @if($product->couches)
            <div class="{{ $tabDetail == 'couches' ? '' : 'hidden' }} grid grid-cols-1 lg:grid-cols-2 mx-1 p-5 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->couches !!}
                    </div>
                </div>
                <div style="max-height: 400px; min-width: 100%">
                    <img src="{{asset('storage/'.$product->couches_images)}}" alt="" srcset="" style="height: 100%; width: 100%">
                </div>
            </div>
            @endif
            @if($product->lighting)
            <div class="{{ $tabDetail == 'lighting' ? '' : 'hidden' }} grid grid-cols-1 lg:grid-cols-2 mx-1 p-5 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->lighting !!}
                    </div>
                </div>
                <div style="max-height: 400px; min-width: 100%">
                    <img src="{{asset('storage/'.$product->lighting_images)}}" alt="" srcset="" style="height: 100%; width: 100%">
                </div>
            </div>
            @endif
            @if($product->driver_station)
            <div class="{{ $tabDetail == 'driver_station' ? '' : 'hidden' }} grid grid-cols-1 lg:grid-cols-2 mx-1 p-5 lg:mx-20 lg:p-12 gap-4">
                <div class="text-white text-sm flex items-center">
                    <div class="text-manipulation">
                        {!! $product->driver_station !!}
                    </div>
                </div>
                <div style="max-height: 400px; min-width: 100%">
                    <img src="{{asset('storage/'.$product->driver_station_images)}}" alt="" srcset="" style="height: 100%; width: 100%">
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