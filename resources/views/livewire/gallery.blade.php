<div>
    <div id="home-gallery-wrapper">
        <div class="lg:flex justify-between" style="margin-bottom: 1rem;">
            <div style="font-weight: 600; font-size: 22px;">Gallery</div>
            <div style="font-size: 22px;"><span>Follow IG : </span>{{$instagram_username}}</div>
        </div>
        <div id="gallery-carousel-wrapper" class="owl-carousel cursor-pointer" style="width: 100%">
                @foreach($galleries as $gallery)
                    <div class="item" style="height: auto">
                        <img src="{{asset('storage/'.$gallery['file'])}}" alt="https//:newarmada.co.id" style="width: 300px; height: 300px;">
                    </div>
                @endforeach
            </div>
    </div>
</div>
