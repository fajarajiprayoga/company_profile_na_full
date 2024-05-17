<div class="nav-overlay-nav" style="{{ $transparent == false ? 'position:relative;' : ''}}">
    <nav style="width: 100%; height: 30px; background-color: rgba(0, 0, 0, 0.15);" class="{{ $transparent == true ? 'bg-transparent' : 'bg-slate-100'}}">
        <div class="d-flex"
            style="position: absolute; margin-top: 10px; margin-right:10px; right: 0; font-size: 13px; {{ $transparent == true ? 'color: white;' : 'color: black;'}}">
            @guest
                <a style="margin-left: 8px;" href="{{route('login')}}"><i class="fa fa-user" aria-hidden="true"></i> Login</a>
            @else
            <div class="flex gap-2">
                @if (Auth::user()->hasRole(['marketing', 'super-admin', 'hr']))
                    <a style="margin-left: 8px;" href="{{route('filament.admin.pages.dashboard')}}"><i class="fa fa-lock" aria-hidden="true"></i> Dashboard</a>
                @endif
                    <button wire:click="logout" type="submit"><i class="fa fa-user" aria-hidden="true"></i> Logout</button>                
            </div>
            @endauth
        </div>
    </nav>
    <nav class="{{ $transparent == true ? 'bg-transparent' : ''}} border-gray-200"
        style="border-bottom: 1px solid white; {{ $transparent == false ? 'background-color: #031843' : 'background-color: rgba(0, 0, 0, 0.15)'}}">
        <div class="hidden lg:block">
            <div class="max-w-screen-xl flex justify-between items-center md:p-4 mx-auto">
                <div class="mx-0 md:block hidden">
                    <a href="https://newarmada.co.id">
                        <img src="{{asset('assets/logo/logona2.png')}}" class="w-64" alt="New Armada Logo" />
                    </a>
                </div>
                <div class="items-center justify-center items-center hidden w-full md:flex" id="navbar-sarch">                
                    <!-- nav Menu -->
                    <ul id="ul-nav" style="font-size: 14px;"
                        class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:space-x-6 md:flex-row md:mt-0 md:border-0 list-none">
                        <li>
                            <a href="{{route('home')}}"
                                class="block py-2 px-3 text-white bg-grey-700 rounded md:bg-transparent md:text-white md:p-0"
                                aria-current="page" style="">Home</a>
                        </li>
                        <li>
                            <a href="{{route('product')}}"
                                class="block py-2 px-3 text-white rounded md:hover:bg-transparent md:hover:text-white md:p-0" style="">Product</a>
                        </li>
                        <li>
                            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white block px-3 py-2 md:p-0" type="button" style="">About
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                <ul class="py-2 text-sm text-gray-700 list-none" aria-labelledby="dropdownDefaultButton">
                                    <li>
                                        <a href="{{route('news')}}" class="block px-4 py-2 dark:hover:bg-gray-400 dark:hover:text-white">News</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 dark:hover:bg-gray-400 dark:hover:text-white">Why New Armada?</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <button id="dropdownCareer" data-dropdown-toggle="dropdown-career" class="text-white block px-3 py-2 md:p-0" type="button" style="">Career
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdown-career" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-28">
                                <ul class="py-2 text-sm text-gray-700 list-none" aria-labelledby="dropdownCareer">
                                    <li>
                                        <a href="{{route('career')}}" class="block px-4 py-2 dark:hover:bg-gray-400 dark:hover:text-white">Career</a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="https://prakerin.mekararmadajaya.com" class="block px-4 py-2 dark:hover:bg-gray-400 dark:hover:text-white">Prakerin</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="{{route('contact')}}"
                                class="block py-2 px-3 text-white rounded md:hover:bg-transparent md:hover:text-white md:p-0" style="">Contact</a>
                        </li>
                        <li>
                            <a href="https://stamping.newarmada.co.id" target="_blank"
                                class="block py-2 px-3 text-white rounded md:hover:bg-transparent md:hover:text-white md:p-0" style="">Stamping & Tools</a>
                        </li>
                    </ul>
                    <!-- nav Menu -->
                </div>            
                <div class="flex justify-end items-center w-64">
                    <!-- Search saat dekstop -->
                    <div class="relative hidden md:block">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search icon</span>
                        </div>
                        <form action="{{route('product')}}" method="get">
                            <input style="background-color: transparent; font-size: 12px;" type="text" id="search-navbar"
                            class="global-search block w-full p-2 ps-10 text-sm text-white border border-white rounded-lg bg-white focus:ring-white focus:border-white"
                            placeholder="Search product" name="keywoard">
                        </form>
                    </div>
                    <!-- Search saat dekstop -->
                </div>
            </div>
        </div>
        <!-- Hamburger menu saat mobile -->
        <div class="flex justify-between items-center lg:hidden w-full p-2">
            <div class="">
                <a href="https://newarmada.co.id">
                    <img src="{{asset('assets/logo/logona2.png')}}" class="w-44" alt="New Armada Logo" />
                </a>
            </div>
            <div class="">
                    <button id="openModal" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg lg:hidden hover:bg-transparent focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <span class="sr-only">Buka Menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
            </div>
        </div>
        <!-- Hamburger menu saat mobile -->
    </nav>
    {{-- Modal menu when mobile view --}}
    <div id="myModal" class="modal">
        <div class="modal-content w-3/4">
            <span class="close-btn" id="closeModalBackground"></span>
            <div class="items-center justify-between w-full flex" id="navbar-search">
                <div class="mt-3 w-full">
                    <form action="{{route('product')}}" method="get">
                        <div class="flex gap-1">
                            <input type="text" id="search-navbar-mobile"
                            class="global-search block w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-primary-800 focus:border-primary-800"
                            placeholder="Search product" name="keywoard">
                            <button type="submit" class="bg-gray-200 px-3 rounded-lg"><svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg></button>
                        </div>
                    </form>
                    <div>
                        <ul id="ul-nav" style="font-size: 14px;"
                    class="p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg list-none">
                        <li>
                            <a href="{{route('home')}}" class="block py-2 px-3" aria-current="page" style="">Home</a>
                        </li>
                        <li>
                            <a href="{{route('product')}}" class="block py-2 px-3" style="">Product</a>
                        </li>
                        <li>
                            <a href="{{route('news')}}" class="block py-2 px-3">News</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-3">Why New Armada?</a>
                        </li>
                        <li>
                            <a href="{{route('career')}}" class="block py-2 px-3">Career</a>
                        </li>
                        <li>
                            <a target="_blank" href="https://prakerin.mekararmadajaya.com" class="block py-2 px-3">Prakerin</a>
                        </li>
                        <li>
                            <a href="{{route('contact')}}" class="block py-2 px-3" style="">Contact</a>
                        </li>
                        <li>
                            <a href="https://stamping.newarmada.co.id" target="_blank" class="block py-2 px-3" style="">Stamping & Tools</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="">
                <button id="closeModal"class="w-full text-sm bg-gray-200 py-1 px-3 rounded-lg mt-4">Close</button>
            </div>
        </div>
    </div>
      {{-- Modal menu when mobile view --}}

      @push('scripts')
          <script>
            const modal = document.getElementById("myModal");
            const openModal = document.getElementById("openModal");
            const closeModalBaclgrpind = document.getElementById("closeModalBackground");
            const closeModal = document.getElementById("closeModal");

            // Membuka modal ketika tombol diklik
            openModal.addEventListener("click", function() {
            modal.style.display = "flex"; // Menggunakan 'flex' untuk pusat horizontal dan vertikal
            });

            // Menutup modal ketika tombol 'X' diklik
            closeModal.addEventListener("click", function() {
            modal.style.display = "none"; // Menyembunyikan modal
            });

            // Menutup modal ketika pengguna mengklik di luar konten modal
            window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
            });
          </script>
      @endpush
</div>