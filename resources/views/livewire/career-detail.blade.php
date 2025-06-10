<div>
<div class="nav-overlay-container">
        <livewire:navbar.navbar :transparent="true"/>
        @if(!empty($footer->background_career))
            <div class="background-menu" background="1" style="background-image: url('{{asset('storage/'.$footer->background_career)}}')">

            </div>
        @endif
    </div>
    <div class="tabs-wrapper mb-12" id="jobs">
        <div class="my-4 lg:my-14">
            
        </div>
        <div class="flex justify-center item-center ">
            <div class="relative overflow-x-auto w-full lg:w-1/2 mx-3">
                <div>
                    <a href="{{route('career')}}" class="text-blue-800 text-sm"><< Back</a>
                </div>
                @if(!empty($job))
                <div id="job-detail-header" class="border-b">
                    <div class="flex justify-between">
                        <div>
                            <span class="text-2xl lg:text-3xl">{{$job->title}}</span>
                        </div>
                        <div class="hidden lg:block">
                            <a id="btn-apply-desktop" target="_blank" href="{{$job->link}}" class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 pointer">Apply</a>
                        </div>
                    </div>
                    <div class="flex gap-3 my-2 text-sm">
                            <div>
                                <i class="fa fa-building text-xs" aria-hidden="true"></i>
                                {{$job->plant->name}}
                            </div>
                            <div>
                                <i class="fa fa-id-card text-xs" aria-hidden="true"></i>
                                {{Str::ucfirst($job->type)}}
                            </div>
                            <div>
                                <i class="fa fa-clock text-xs" aria-hidden="true"></i>
                                @if ($job->updated_at == "")
                                    Posted {{\Carbon\Carbon::parse($job->created_at)->diffForHumans()}}
                                @else
                                    Updated {{\Carbon\Carbon::parse($job->updated_at)->diffForHumans()}}
                                @endif
                            </div>
                    </div>
                </div>
                <div class="my-5" style="font-size: 15px; line-height: 22px;">
                    <div id="job-description" class="text-md">
                        {!! $job->description !!}
                    </div>
                    <div class="mt-5">
                        <div class="text-xl mb-2">
                            Qualification :
                        </div>
                        <div id="job-qualification">
                            {!! $job->qualification !!}
                        </div>
                    </div>
                    <div class="mt-5">
                        <div id="job-other-info">
                            {!! $job->other_info !!}
                        </div>
                    </div>
                </div>
                <div class="my-5 flex lg:hidden">
                    <a id="btn-apply-mobile" target="_blank" href="{{$job->link}}" class="w-full text-center text-white bg-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 ">
                        Apply
                    </a>
                </div>
                @else
                <span>Vacancy not found, please search on the </span> <a href="{{route('career')}}" class="italic text-blue-800">career</a> <span> page.</span>
                @endif
            </div>
        </div>
    </div>
    <livewire:footer.footer />
</div>


@push('scripts')
        <script>
            window.onload = function() {
                var label = "/career/{{ $job->slug }}/{{ strtolower($job->plant->name) }}";
                

                var btnDesktop = document.getElementById('btn-apply-desktop');
                if (btnDesktop) {
                    btnDesktop.addEventListener('click', function() {
                        event.preventDefault();
                        
                        // Kirim event Google Analytics
                        gtag('event', 'click_apply_button', {
                            event_category: 'Career',
                            event_label: label,
                            value: 1
                        });

                        setTimeout(function() {
                            window.open(btnDesktop.href, '_blank');
                        }, 300);
                    });
                }

                var btnMobile = document.getElementById('btn-apply-mobile');
                if (btnMobile) {
                    btnMobile.addEventListener('click', function() {
                        event.preventDefault();
                        
                        // Kirim event Google Analytics
                        gtag('event', 'click_apply_button', {
                            event_category: 'Career',
                            event_label: label,
                            value: 1
                        });

                        setTimeout(function() {
                            window.open(btnMobile.href, '_blank');
                        }, 300);
                    });
                }
            };
        </script>
@endpush
