<div>
    <div class="nav-overlay-container">
        <livewire:navbar.navbar :transparent="true"/>
        @if(!empty($footer->background_contact))
            <div class="background-menu" background="1" style="background-image: url('{{asset('storage/'.$footer->background_contact)}}')">

            </div>
        @endif
    </div>
    <div class="tabs-wrapper">
        <div class="my-4 lg:my-14">
            <div class="flex justify-center">
                <span class="font-semibold text-lg">Contact Us</span>
            </div>
            <div class="flex justify-center mt-12 text-center">
                If you have any questions or need information, please contact the following number.
            </div>
        </div>
        <div class="flex justify-center item-center">
            <div class="relative overflow-x-auto w-full lg:w-1/2 mx-3">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <tbody>
                        @foreach($contacts as $contact)
                            <tr class="bg-white border-b">
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{$contact->name}}</th>
                                <td class="px-6 py-4"><a target="_blank" href="{{'https://wa.me/62'.substr($contact->telephone, 1)}}">{{$contact->telephone}}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div>
        <div class="section-title my-12" style="color: black;">
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