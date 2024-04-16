<div>
    <div id="home-gallery-wrapper">
        <div class="lg:flex justify-between" style="margin-bottom: 1rem;">
            <div class="lg:text-2xl text-lg font-semibold">Gallery</div>
            <div class="lg:text-2xl text-lg"><span>Follow IG : </span>{{$instagram_username}}</div>
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
