<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-2 sm:p-8 grid grid-cols-3">
                <div class="flex justify-center items-center border-r border-gray-500">
                    <img class="" src="{{asset('assets/logo/logona.png')}}" alt="logo" style="width: 70px; height: 70px;">
                </div>
                <div class="col-span-2">
                    <div>
                        <div class="text-center">
                            <span>Masukan Kode OTP</span>
                        </div>
                        <form class="" wire:submit="otp">
                            <div class="flex justify-center items-center">
                                <input type="password" wire:model="otpForm.otp" id="otp"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-primary-600 focus:border-primary-600 p-2.5 w-32"
                                    placeholder="Verification Code" required="">
                                <button type="submit" wire:click="handleClick" wire:loading.attr="disabled" 
                                    class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium text-sm px-5 py-2.5 text-center">
                                    <span><div wire:loading class="border-y-2 border-white border-solid rounded-full h-3 w-3 animate-spin mr-2"></div>Process</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="text-center text-red-500">
                        @error('otpForm.otp') <p class="text-sm">{{ $message }}</p> @enderror
                    </div>
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