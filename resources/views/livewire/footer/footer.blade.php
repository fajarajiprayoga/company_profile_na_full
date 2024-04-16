<div>
<footer class="p-4 sm:p-6" style="background-color: #031843">
    <div class="mx-auto max-w-screen-xl">
        <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0">
                <a href="https://newarmada.co.id" class="flex items-center">
                    <img src="{{asset('assets/logo/logona2.png')}}" class="mr-3 h-8" alt="FlowBite Logo" />
                </a>
                <div class="text-white font-medium mt-3" style="max-width: 600px; font-size: 14px;">
                    @if(!empty($footer->address))
                    {!! $footer->address !!}
                    @endif
                </div>
            </div>
            <div class="grid grid-cols-2 gap-1 sm:gap-1 sm:grid-cols-3 text-sm lg:text-base">
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase text-white">Follow Us</h2>
                    <ul class="text-gray-400 list-none">
                        <li class="mb-4">
                            <a target="_blank" href="{{!empty($footer->youtube_url) ? $footer->youtube_url : '#'}}" class="hover:underline font-medium" style="font-size: 15px;">Youtube</a>
                        </li>
                        <li class="mb-4">
                            <a target="_blank" href="{{!empty($footer->instagram_url) ? $footer->instagram_url : '#'}}" class="hover:underline font-medium" style="font-size: 15px;">Instagram</a>
                        </li>
                        <li>
                            <a target="_blank" href="{{!empty($footer->facebook_url) ? $footer->facebook_url : '#'}}" class="hover:underline font-medium" style="font-size: 15px;">Facebook</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase text-white">Online Services</h2>
                    <ul class="text-gray-400 list-none">
                        <li class="mb-4">
                            <a target="_blank" href="{{!empty($footer->shopee_url) ? $footer->shopee_url : '#'}}" class="hover:underline font-medium" style="font-size: 15px;">Shopee</a>
                        </li>
                        <li>
                            <a target="_blank" href="{{!empty($footer->tokopedia_url) ? $footer->tokopedia_url : '#'}}" class="hover:underline font-medium" style="font-size: 15px;">Tokopedia</a>
                        </li>
                    </ul>
                </div>
                <div class="pt-5 sm:pt-0">
                    <h2 class="mb-6 text-sm font-semibold uppercase text-white">Contact</h2>
                    <ul class="text-gray-400 list-none">
                        <li class="mb-4">
                            <a href="#" class="hover:underline font-medium " style="font-size: 15px;">{{!empty($footer->email) ? $footer->email : 'Email'}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-6 sm:mx-auto border-gray-700 lg:my-8" />
        <div class="sm:flex sm:items-center sm:justify-center text-center">
            <span class="text-sm sm:text-center text-gray-400 font-sm text-sm">© 2024 <a href="https://newarmada.co.id" class="hover:underline">PT Mekar Armada Jaya</a>. Designed by Business Development Team. Powered by IT Team.
            </span>
        </div>
    </div>
</footer>
</div>
