<div>
    <div class="nav-overlay-container">
        <livewire:navbar.navbar :transparent="true"/>
        @if(!empty($footer->background_product))
            <div class="background-menu" background="1" style="background-image: url('{{asset('storage/'.$footer->background_product)}}')">
            </div>
        @endif
    </div>
    @if($searched != '')
        <div class="tabs-wrapper">
            <div class="my-4 lg:my-14">
                <div class="flex justify-center mt-12">
                    <span>Hasil pencarian : {{$keywoard}}</span>
                </div>
                @if(count($searched) != 0)
                <div class="mt-5 px-4 lg:px-14 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 mb-14">
                    @foreach($searched as $data)
                    <a href="{{route('product-detail', $data->slug)}}" class="p-4 item-product-list">
                        <div class="flex w-full items-center justify-center mb-4">
                            <img src="{{asset('storage/'.$data['images'])}}" alt="" srcset="" class=""
                                style="height: 250px; width: 250px;">
                        </div>
                        <div class="px-7 mb-4">
                            <span class="font-semibold text-base leading-5 mb-2 block"
                                style="font-family: 'Poppins', sans-serif;">{{$data->name}}</span>
                            <span class="block font-medium text-xs text-gray-400"
                                style="font-family: 'Poppins', sans-serif;">{{$data->type->name}}</span>
                        </div>
                        <button type="button"
                            class="common-link inline-block relative py-2 bg-transparent cursor-pointer px-7 mb-4">
                            <span class="font-medium text-sm">Detail Model</span>
                        </button>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="flex justify-center mt-5">
                    <span class="text-red-500">Produk yang anda cari tidak tersedia</span>
                </div>
                @endif
            </div>
        </div>
    @endif

    <div id="tab-product"></div>
    
    <div class="tabs-wrapper">
        <div class="tabs-header shadow-md text-center">
            @foreach($types as $type)
            <button class="{{ $type->id == $type_id ? 'tabs-item-active' : 'tabs-item text-gray-500' }}"
                wire:click="type({{$type->id}})">{{$type->name}}</button>
            @endforeach
        </div>
        <div class="my-4 lg:my-14" wire:loading.class.delay="opacity-75">
            <div class="flex justify-center text-center">
                <div>
                    <span class="font-semibold text-lg">{{$type_name}}</span>
                    <div class="mt-12 mx-auto">
                        @if(count($products) != 0)
                        <span class="text-sm font-medium uppercase" style="letter-spacing: 0.5rem; margin-left: 0.5rem;">Our Best Models</span>
                        @else
                        <span class="text-sm font-medium uppercase" style="letter-spacing: 0.5rem; margin-left: 0.5rem;">Coming Soon</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="px-2 lg:px-14 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 lg:gap-16 mb-14" wire:loading.class.delay="opacity-75">
            @foreach($products as $product)
            <a href="{{route('product-detail', $product->slug)}}" class="p-4 item-product-list">
                <div class="flex w-full items-center justify-center mb-4">
                    <img src="{{asset('storage/'.$product['images'])}}" alt="" srcset="" class=""
                        style="height: 250px; width: 250px;">
                </div>
                <div class="px-7 mb-4">
                    <span class="font-semibold text-base leading-5 mb-2 block"
                        style="font-family: 'Poppins', sans-serif;">{{$product->name}}</span>
                    <span class="block font-medium text-xs text-gray-400"
                        style="font-family: 'Poppins', sans-serif;">{{$product->type->name}}</span>
                </div>
                <button type="button"
                    class="common-link inline-block relative py-2 bg-transparent cursor-pointer px-7 mb-4">
                    <span class="font-medium text-sm">Detail Model</span>
                </button>
            </a>
            @endforeach
        </div>
    </div>

    <livewire:gallery />
    <livewire:footer.footer />
</div>