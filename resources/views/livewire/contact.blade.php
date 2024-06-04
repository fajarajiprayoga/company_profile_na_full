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
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap w-full">{{$contact->name}}</th>
                                <td class="px-6 py-4">
                                    <a target="_blank" href="{{'https://wa.me/62'.substr($contact->telephone, 1)}}" class="text-green-600 flex justify-center items-center gap-1">
                                        <span>{{$contact->telephone}}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-whatsapp mb-1" viewBox="0 0 16 16">
                                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                          </svg>
                                    </a>
                                </td>
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