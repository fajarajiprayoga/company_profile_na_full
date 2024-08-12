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
                <span class="font-semibold text-lg">New Job Openings</span>
            </div>
            <div class="flex justify-center mt-12 text-center">
                Choose jobs that match your work experience!
            </div>
        </div>
        <div class="flex justify-center item-center">
            <div class="relative overflow-x-auto w-full lg:w-3/5 mx-3">
                <div class="lg:flex justify-between">
                    <div class="w-full p-0 lg:p-1">
                        <input wire:model.live="search" type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5 mb-3 lg:mb-6" placeholder="Search jobs">
                    </div>
                    <div class="w-full lg:w-80 p-0 lg:p-1">
                        <select wire:model.live="search_plant" id="default" class="bg-gray-50 border border-gray-300 text-gray-900 mb-3 lg:mb-6 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5">
                            <option value="">Select Job Plant</option>
                            @foreach($plants as $plant)
                                <option value="{{$plant->id}}">{{$plant->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full lg:w-80 p-0 lg:p-1">
                        <select wire:model.live="search_type" id="default" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5">
                            <option value="">Select Job Type</option>
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
                    <a href="{{ route('career_detail', ['title' => $job->slug, 'plant' => Str::slug($job->plant->name)]) }}">
                        <div class="p-3 border-x border-b {{ $loop->index == 0 ? 'border-t' : '' }} {{ $loop->index % 2 != 0 ? 'bg-gray-50 hover:bg-gray-100' : 'hover:bg-gray-100' }}">
                            <div class="text-blue-900 font-bold">
                                {{$job->title}}
                            </div>
                            <div class="flex justify-between text-sm mt-2">
                                <div>
                                    <i class="fa fa-building text-xs" aria-hidden="true"></i>
                                    {{$job->plant->name}}
                                </div>
                                <div>
                                    <i class="fa fa-id-card text-xs" aria-hidden="true"></i>
                                    {{ Str::ucfirst($job->type) }}
                                </div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div>
                        Jobs not available
                    </div>
                    @endforelse
                </div>
                <div class="mt-3">
                    {{ $jobs->links(data: ['scrollTo' => '#jobs']) }}
                </div>
            </div>
        </div>
    </div>

    <livewire:gallery />
    <livewire:footer.footer />
</div>
