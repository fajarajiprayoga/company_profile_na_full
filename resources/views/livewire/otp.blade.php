<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0 max-w-sm py-10 dark:bg-gray-800 dark:border-gray-700">
                <div class="">
                    <div>
                        <img class="mx-auto w-20 mb-3" src="{{asset('assets/logo/logona.png')}}" alt="">
                        <div class="text-center mb-2">
                            <div>
                                <span class="text-xl">Email Verification</span>
                            </div>
                            <div>
                                <span class="text-sm font-thin text-gray-500">We have sent a code to your email</span>
                            </div>
                        </div>
                        <div class="text-center mx-12 lg:mx-20">
                            <form class="" wire:submit="otp">
                                <div class="flex">
                                    <input type="password" wire:model="otpForm.otp" id="otp"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-primary-600 focus:border-primary-600 p-2.5 w-full"
                                        placeholder="Input Our OTP Code" required="">
                                    <button type="submit" wire:click="handleClick" wire:loading.attr="disabled" 
                                        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium text-sm py-2.5 px-2 text-center ">
                                        
                                        <div wire:loading class="border-y-2 border-white border-solid rounded-full animate-spin w-5 h-5 mx-3"></div>
                                        <div wire:loading.class="hidden" style="padding: 0 1px;">Verify</div>
                                    </button>
                                </div>
                                <div>
                                    <div class="text-sm font-thin text-gray-500 mt-2">
                                        <span>Didn't receive code?</span>
                                        <a href="{{route('login')}}" class="text-blue-500">Login</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-center text-red-500">
                        @error('otpForm.otp') <p class="text-sm">{{ $message }}</p> @enderror
                    </div>
                </div>
        </div>
    </div>
</section>
@if(session()->has('otp-failed'))
<script>
    var msg = '{{session("otp-failed")}}';
    Swal.fire({
        text: msg,
        position: "top-end",
        icon: 'error',
        toast: true,
        showCloseButton: false,
        showCancelButton: false,
        showConfirmButton: false,
        timer: 2000
    })
</script>
@endif