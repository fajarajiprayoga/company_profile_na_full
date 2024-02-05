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
                    <a href="{{route('career')}}" class="text-blue-800 text-sm"><< Kembali</a>
                </div>
                <div id="job-detail-header" class="border-b">
                    <div class="flex justify-between">
                        <div>
                            <span class="text-3xl">{{$job->title}}</span>
                        </div>
                        <div>
                            <a target="_blank" href="{{$job->link}}" class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 pointer">Lamar</a>
                        </div>
                    </div>
                    <div class="flex gap-3 my-2 text-sm">
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
                                @elseif($job->type == 'Manager')
                                    manager
                                @else
                                @endif
                            </div>
                    </div>
                </div>
                <div class="my-5" style="font-size: 15px; line-height: 22px;">
                    <div class="text-md">
                        {!! $job->description !!}
                    </div>
                    <div class="mt-5">
                        <div class="text-xl mb-2">
                            Kualifikasi :
                        </div>
                        <div>
                            {!! $job->qualification !!}
                        </div>
                    </div>
                    <div class="mt-5">
                        <div>
                            {!! $job->other_info !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:footer.footer />
</div>
