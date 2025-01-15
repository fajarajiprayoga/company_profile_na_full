<div>
    <div id="home-instagram-post-wrapper" class="space-y-4">
        <div class="flex flex-col lg:flex-row justify-between items-center">
            <h2 class="text-lg lg:text-2xl font-semibold">Instagram Post</h2>
            <div class="text-lg lg:text-2xl">
                <span>Follow IG: </span>
                <span class="font-medium">{{$instagram_username}}</span>
            </div>
        </div>
        
        {{-- Desktop View --}}
        <div class="hidden lg:block">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($instagram_post as $post)
                    <div class="w-full">
                        <iframe src="https://www.instagram.com/p/{{$post->id_post}}/embed/captioned" 
                                allowtransparency="true" 
                                allowfullscreen="true" 
                                frameborder="0" 
                                height="850"
                                class="w-full bg-white border border-gray-300 rounded-md shadow-sm" 
                                scrolling="no">
                        </iframe>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Mobile View --}}
        <div class="block lg:hidden">
            <div class="relative w-full" data-carousel="">
                <!-- Carousel wrapper -->
                <div class="relative overflow-hidden rounded-lg" style="height: 800px;">
                    @foreach ($instagram_post as $post)
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <iframe src="https://www.instagram.com/p/{{$post->id_post}}/embed/captioned" 
                                allowtransparency="true" 
                                allowfullscreen="true" 
                                frameborder="0" 
                                height="750"
                                class="w-full bg-white border border-gray-300 rounded-md shadow-sm" 
                                scrolling="no">
                            </iframe>
                        </div>
                    @endforeach
                </div>
                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev style="left: -2.75rem">
                    <span class="inline-flex items-center justify-center w-6 h-6 bg-black">
                        <svg class="w-2 h-2 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next style="right: -2.75rem">
                    <span class="inline-flex items-center justify-center w-6 h-6 bg-black">
                        <svg class="w-2 h-2 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>
    </div>    
</div>
