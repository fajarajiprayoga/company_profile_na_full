<div>
<div class="nav-overlay-container">
        <livewire:navbar.navbar :transparent="true"/>
        @if(!empty($footer->background_career))
            <div class="background-menu" background="1" style="background-image: url('{{asset('storage/'.$footer->background_career)}}')">

            </div>
        @endif
    </div>
    <div class="tabs-wrapper" id="jobs">
        <div class="my-4 lg:my-14">
            <div class="flex justify-center" id="jobs-title">
                <span class="font-semibold text-lg">Peluang Kerja Terbaru</span>
            </div>
            <div class="flex justify-center mt-12 text-center">
            Pilih lowongan yang sesuai dengan pengalaman kerjamu!
            </div>
        </div>
        <div class="flex justify-center item-center">
            <div class="relative overflow-x-auto w-full lg:w-3/5 mx-3">
                <div class="lg:flex justify-between gap-3">
                    <div class="w-full">
                        <input wire:model.live="search" type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5 mb-3 lg:mb-6" placeholder="Cari lowongan">
                    </div>
                    <div class="w-full">
                        <select wire:model.live="search_plant" id="default" class="bg-gray-50 border border-gray-300 text-gray-900 mb-3 lg:mb-6 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5">
                            <option value="">Pilih Plant</option>
                            @foreach($plants as $plant)
                                <option value="{{$plant->id}}">{{$plant->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full lg:w-80">
                        <select wire:model.live="search_type" id="default" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5">
                            <option value="">Pilih Tipe</option>
                            <option value="support">Support</option>
                            <option value="staff">Staff</option>
                            <option value="leader">Leader</option>
                            <option value="supervisor">Supervisor</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>
                </div>
                <div wire:loading.class.delay="opacity-75">
                    @forelse($jobs as $job)
                    <a href="{{ route('career_detail', Crypt::encrypt($job->id)) }}">
                        <div class="my-3 border-y py-1 hover:bg-gray-100">
                            <div class="text-blue-900 font-bold">
                                {{$job->title}}
                            </div>
                            <div class="flex justify-between text-sm mt-2">
                                <div>
                                    <i class="fa fa-building text-xs" aria-hidden="true"></i>
                                    {{$job->plant->name}}
                                </div>
                                <div>
                                    <i class="fa fa-clock text-xs" aria-hidden="true"></i>
                                    @if($job->type == 'support')
                                    Support
                                    @elseif($job->type == 'staff')
                                    Staff
                                    @elseif($job->type == 'leader')
                                    Leader
                                    @elseif($job->type == 'supervisor')
                                    Supervisor
                                    @elseif($job->type == 'manager')
                                    Manager
                                    @else
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div>
                        Lowongan belum tersedia
                    </div>
                    @endforelse
                </div>
                {{ $jobs->links(data: ['scrollTo' => '#jobs']) }}
            </div>
        </div>
    </div>

    <livewire:gallery />
    <livewire:footer.footer />
</div>
