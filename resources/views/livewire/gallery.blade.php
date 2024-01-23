<div>
    <div id="home-gallery-wrapper">
        <div class="lg:flex justify-between" style="margin-bottom: 1rem;">
            <div style="font-weight: 600; font-size: 22px;">Gallery</div>
            <div style="font-size: 22px;"><span>Follow IG : </span>{{$instagram_username}}</div>
        </div>
        <div id="gallery-carousel-wrapper" class="owl-carousel cursor-pointer" style="width: 100%">
                @foreach($galleries as $gallery)
                    <div class="item" style="width: 100%; height: 240px;">
                        <img src="{{asset('storage/'.$gallery['file'])}}" alt="https//:newarmada.co.id" style="object-fit: cover; height: 100%;">
                    </div>
                @endforeach
            </div>
    </div>
</div>
