<div>
<div class="nav-overlay-container">
        <livewire:navbar.navbar :transparent="true"/>
        @if(!empty($footer->background_contact))
            <div class="background-menu" background="1" style="background-image: url('{{asset('storage/'.$footer->background_contact)}}')">
                <div class="page-carousel-text text-center">
                    Download Center
                </div>
            </div>
        @endif
    </div>
    <div class="tabs-wrapper">
        <div class="my-4 lg:my-14">
            <div class="flex justify-center">
                <span class="font-semibold text-lg">Download Katalog</span>
            </div>
        </div>
        <div class="flex justify-center item-center">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <tbody>
                        @foreach($catalogs as $catalog)
                            <tr class="bg-white border-b">
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{$catalog->name}}</th>
                                <td class="px-6 py-4">
                                    <i class="fa fa-download cursor-pointer" wire:click="download('{{$catalog->slug}}')"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <livewire:gallery />
    <livewire:footer.footer />
</div>
