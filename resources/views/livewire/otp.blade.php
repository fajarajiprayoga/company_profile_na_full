<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <div class="flex items-center mx-auto mb-6" style="width: 250px;">
                    <img class="text-center" src="{{asset('assets/logo/logona2.png')}}" alt="logo">
                </div>
                <form class="space-y-4 md:space-y-6" wire:submit="otp">
                    <div class="flex item-center justify-center">
                        <input type="password" wire:model="otpForm.otp" id="otp"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-primary-600 focus:border-primary-600 block w-50 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Verification Code" required="">
                        <button type="submit"
                            class="w-50 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Process</button>
                    </div>
                </form>
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