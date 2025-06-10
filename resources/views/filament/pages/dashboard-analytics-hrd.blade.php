<x-filament-panels::page>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 p-6">
            <div class="mb-5">
                <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950">Filter</h3>
            </div>
            {{$this->form}}
            <x-filament::button class="mt-3" wire:click="generate">
                Generate
            </x-filament::button>
        </div>
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 p-6">
            <div class="mb-5">
                <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950">Report</h3>
            </div>
            <form wire:submit="generateReport">
                {{$this->formReport}}
                <x-filament::button class="mt-3" color="success" type="submit">
                    Generate
                </x-filament::button>
            </form>
        </div>
    </div>
    <div style="display: grid; grid-template-columns: 50% 50%; gap: 10px;">
        <div>
            <div style="height: 500px" class="fi-wi-stats-overview-card relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5">
                <div class="grid gap-y-4">
                    <div class="flex items-center justify-between gap-x-2">
                        <div>
                            <span class="text-lg font-semibold text-gray-500">
                                Visitors per Job
                            </span>
                            <br>
                            <span class="text-sm font-semibold text-gray-400">
                                Jumlah pengunjung per lowongan
                            </span>
                        </div>
                        <div>
                            {{$this->searchCareer}}
                        </div>
                    </div>

                    <div class="relative">
                        <div style="margin-right: 10px;">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="table-layout: fixed;">
                                <colgroup>
                                    <col style="width: 40%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                </colgroup>
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-2">
                                            Product Name
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                Views
                                            </div>
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                Apply Clicked
                                            </div>
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                %
                                            </div>
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                AVG Duration
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div style="max-height: 290px;" class="overflow-y-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="table-layout: fixed;">
                                <colgroup>
                                    <col style="width: 40%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                </colgroup>
                                <tbody>
                                    @foreach ($careerDatas as $career)
                                        <tr class="bg-white border-b border-gray-200">
                                            <th scope="row" class="px-3 py-2 font-medium text-gray-900">
                                                <a href="{{env('APP_URL').$career['pagePath']}}" target="_blank">
                                                    {{$career['careerTitle']}}
                                                </a>
                                            </th>
                                            <td class="px-3 py-2">
                                                <x-filament::badge class="tabular-nums shrink-0" size="xs">
                                                    {{$career['screenPageViews']}}
                                                </x-filament::badge>
                                            </td>
                                            <td class="px-3 py-2">
                                                <x-filament::badge class="tabular-nums shrink-0" color="gray" size="xs">
                                                    {{$career['clickApplyButton']}}
                                                </x-filament::badge>
                                            </td>
                                            <td class="px-3 py-2">
                                                <x-filament::badge class="tabular-nums shrink-0" color="gray" size="xs">
                                                    {{$career['percent_by_views_vs_click']}}
                                                </x-filament::badge>
                                            </td>
                                            <td class="px-3 py-2">
                                                <x-filament::badge class="tabular-nums shrink-0" color="success" size="xs">
                                                    {{gmdate('i:s', (int) $career['sessionDuration'])}}
                                                </x-filament::badge>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-right: 10px;">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="table-layout: fixed;">
                                <colgroup>
                                    <col style="width: 40%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                </colgroup>
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-2">
                                            Summary
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                {{$careerDatas->sum('screenPageViews')}}
                                            </div>
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                {{$careerDatas->sum('clickApplyButton')}}
                                            </div>
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                @if ($careerDatas->sum('clickApplyButton') != 0)
                                                    {{round(($careerDatas->sum('clickApplyButton') / $careerDatas->sum('screenPageViews')) * 100,2)}}
                                                @else
                                                    0
                                                @endif
                                            </div>
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                {{gmdate('i:s', (int) $careerDatas->avg('sessionDuration'))}}
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div style="height: 500px" class="fi-wi-stats-overview-card relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5">
                <div class="grid gap-y-4">
                    <div class="flex items-center justify-between gap-x-2">
                        <div>
                            <span class="text-lg font-semibold text-gray-500">
                                Visitors by Region
                            </span>
                            <br>
                            <span class="text-sm font-semibold text-gray-400">
                                Jumlah pengunjung per Wilayah Provinsi
                            </span>
                        </div>
                    </div>

                    <div class="relative">
                        <div style="margin-right: 10px;">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="table-layout: fixed;">
                                <colgroup>
                                    <col style="width: 40%;">
                                    <col style="width: 30%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                </colgroup>
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-2">
                                            Region
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            Country
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                Views
                                            </div>
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                AVG Duration
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div style="max-height: 270px;" class="overflow-y-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="table-layout: fixed;">
                                <colgroup>
                                    <col style="width: 40%;">
                                    <col style="width: 30%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                </colgroup>
                                <tbody>
                                    @foreach ($viewerByRegion as $region)
                                        <tr class="bg-white border-b border-gray-200">
                                            <th scope="row" class="px-3 py-2 font-medium text-gray-900">
                                                {{$region['region']}}
                                            </th>
                                            <th scope="row" class="px-3 py-2 font-medium text-gray-900">
                                                {{$region['country']}}
                                            </th>
                                            <td class="px-3 py-2">
                                                <x-filament::badge class="tabular-nums shrink-0" size="xs">
                                                    {{$region['screenPageViews']}}
                                                </x-filament::badge>
                                            </td>
                                            <td class="px-3 py-2">
                                                <x-filament::badge class="tabular-nums shrink-0" color="success" size="xs">
                                                    {{gmdate('i:s', $region['averageSessionDuration'])}}
                                                </x-filament::badge>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-right: 10px;">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="table-layout: fixed;">
                                <colgroup>
                                    <col style="width: 40%;">
                                    <col style="width: 30%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                </colgroup>
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-2">
                                            Summary
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                {{$viewerByRegion->sum('screenPageViews')}}
                                            </div>
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                {{gmdate('i:s', $viewerByRegion->avg('averageSessionDuration'))}}
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
