<div>
    <div class="nav-overlay-container">
        <livewire:navbar.navbar :transparent="true"/>
        @if(!empty($footer->background_contact))
            <div class="background-menu" background="1" style="background-image: url('{{asset('storage/'.$footer->background_contact)}}')">
                <div class="page-carousel-text text-center">
                    Kontak
                </div>
            </div>
        @endif
    </div>
    <div class="tabs-wrapper">
        <div class="my-4 lg:my-14">
            <div class="flex justify-center">
                <span class="font-semibold text-lg">Hubungi Kami</span>
            </div>
            <div class="flex justify-center mt-12 text-center">
            Jika Anda memiliki pertanyaan atau membutuhkan informasi, silakan hubungi nomor berikut :
            </div>
        </div>
        <div class="flex justify-center item-center">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <tbody>
                        @foreach($contacts as $contact)
                            <tr class="bg-white border-b">
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{$contact->name}}</th>
                                <td class="px-6 py-4">{{$contact->telephone}}</td>
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