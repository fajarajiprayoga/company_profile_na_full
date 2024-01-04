<div>
    <div class="nav-overlay-container">
        <livewire:navbar.navbar :transparent="true" />
        @if(!empty($product->wallpaper))
        <div class="background-menu" background="1"
            style="background-image: url('{{asset('storage/'.$product->wallpaper)}}')">
            <div class="page-carousel-text text-center">
                {{$product->name}}
            </div>
        </div>
        @endif
    </div>
    <div class="mx-5 my-14">
        <div class="grid grid-cols-1 lg:grid-cols-3">
            <div class="p-5">
                <div>
                    {!! $product->description !!}
                </div>
                <button
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center text-sm mt-12">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                    </svg>
                    <span>Download Catalog</span>
                </button>
            </div>
            <div class="bg-yellow-500 p-5">
                <div class="max-w-sm p-12 border-none shadow bg-zinc-800">
                    <table class="w-full text-xs text-left rtl:text-right text-gray-500">
                        <tbody>
                            <tr class="border-b text-white">
                                <th class="py-4 font-normal rext-left whitespace-nowrap">Brand</th>
                                <td class="py-4 font-medium text-right">{{$product->brand}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-green-500 p-5">
                Hello World
            </div>
        </div>
    </div>

    <livewire:footer.footer />
</div>