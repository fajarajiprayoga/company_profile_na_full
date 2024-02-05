<div>
<div class="nav-overlay-container">
        <livewire:navbar.navbar :transparent="true"/>
        @if(!empty($footer->background_news))
            <div class="background-menu" background="1" style="background-image: url('{{asset('storage/'.$footer->background_news)}}')">

            </div>
        @endif
    </div>
    <div class="tabs-wrapper mb-5" id="news">
        <div id="news" class="lg:mx-32 my-5 mx-1 lg:flex lg:justify-between">
            <div class="font-bold text-2xl text-blue-900 ">
                {{ !empty($category_title) && $this->category != 'all' ? $category_title : 'Semua Berita' }}
            </div>
            <div class="lg:flex justify-between gap-3">
                    <div class="w-full">
                        <input wire:model.live="search" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5 mb-3 lg:mb-6" placeholder="Cari berita">
                    </div>
                    <div class="w-full lg:w-56">
                        <select wire:model.live="search_year" class="bg-gray-50 border border-gray-300 text-gray-900 mb-3 lg:mb-6 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5">
                            <option value="semua">Pilih Tahun</option>
                            @foreach($years as $year)
                                <option value="{{$year}}">{{$year}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full lg:w-56">
                        <select wire:model.live="search_time" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5">
                            <option value="desc">Terbaru</option>
                            <option value="asc">Terdahulu</option>
                        </select>
                    </div>
                </div>
        </div>
        <div class="lg:mx-32 mx-1 lg:grid lg:grid-cols-3 lg:gap-4">
            <div class="mb-2 lg:mb-0">
                <div class="block p-6 bg-white border border-gray-200 rounded-lg">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Kategori</h5>
                    <a href="{{ route('news', ['category' => 'all'])  . '#news' }}">
                        <p class="{{ $category == 'all' || $category == '' ? 'text-blue-900 font-semibold' : 'text-gray-700 font-normal' }} text-base">Semua</p>
                    </a>
                    @foreach($categories as $data)
                        <a href="{{ route('news', ['category' => $data->slug]) . '#news' }}">
                            <p class="{{ $data->slug == $category ? 'text-blue-900 font-semibold' : 'text-gray-700 font-normal' }} text-base">{{$data->title}}</p>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-span-2">
                <div wire:loading.class.delay="opacity-75" class="lg:grid lg:grid-cols-2 lg:gap-3 mb-0 sm:mb-5">
                    @forelse($news as $data)
                    <div class="relative bg-white border border-gray-200 rounded-lg shadow"  style="min-height: 510px;">
                        <div class="relative overflow-hidden">
                            <a href="{{ route('news-detail', $data->slug) }}">
                                <img class="rounded-t-lg transition-transform transform hover:scale-110" src="{{asset('storage/'.$data['thumbnail'])}}" alt="" />
                            </a>
                        </div>
                        <div class="p-5">
                            <div>
                                <span class="text-sm text-gray-500">
                                    {{ strftime('%a, %e %b %Y', strtotime($data->created_at)) }}
                                </span>
                                <span class="text-sm text-gray-500">|</span>
                                <span class="text-sm text-gray-500">{{$data->category->title}}</span>
                            </div>
                            <a href="{{ route('news-detail', $data->slug) }}">
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{{ Str::limit($data->title, 63, "...") }}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700">
                                {!! Str::limit($data->content, 135, "...") !!}
                            </p>
                            <div class="absolute bottom-3 left-3">
                                <a href="{{ route('news-detail', $data->slug) }}" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-blue-600 hover:underline">
                                    Read more
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="lg:col-span-2 text-center">
                            <span>
                                Maaf, kata kunci yang anda cari belum tersedia. Silahkan cari dengan kata kunci lain
                            </span>
                        </div>
                    @endforelse
                </div>
                {{ $news->links(data: ['scrollTo' => '#news']) }}
            </div>
        </div>
    </div>
    <livewire:footer.footer />
</div>
