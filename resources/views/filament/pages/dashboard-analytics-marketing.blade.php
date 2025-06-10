<x-filament-panels::page>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div>
            {{$this->form}}
            <x-filament::button class="mt-3" wire:click="generate">
                Generate
            </x-filament::button>
        </div>
    </div>
    <div style="display: grid; grid-template-columns: 40% 60%; gap: 10px;">
        <div>
            <div style="height: 500px" class="fi-wi-stats-overview-card relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5">
                <div class="grid gap-y-4">
                    <div class="flex items-center justify-between gap-x-2">
                        <div>
                            <span class="text-lg font-semibold text-gray-500 dark:text-gray-100">
                                Product Page Visitors
                            </span>
                            <br>
                            <span class="text-sm font-semibold text-gray-400 dark:text-gray-100">
                                Jumlah pengunjung per produk
                            </span>
                        </div>
                        <div>
                            {{$this->searchProduct}}
                        </div>
                    </div>

                    <div class="relative">
                        <div style="margin-right: 10px;">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="table-layout: fixed;">
                                <colgroup>
                                    <col style="width: 60%;">
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
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
                                    <col style="width: 60%;">
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                </colgroup>
                                <tbody>
                                    @foreach ($productDatas as $product)
                                        <tr class="bg-white border-b border-gray-200">
                                            <td scope="row" class="px-3 py-2 font-medium text-gray-900">
                                                <a href="{{env('APP_URL').$product['pagePath']}}" target="_blank">
                                                    {{$product['productTitle']}}
                                                </a>
                                            </td>
                                            <td class="px-3 py-2">
                                                <x-filament::badge class="tabular-nums shrink-0" size="xs">
                                                    {{$product['screenPageViews']}}
                                                </x-filament::badge>
                                            </td>
                                            <td class="px-3 py-2">
                                                <x-filament::badge class="tabular-nums shrink-0" color="success" size="xs">
                                                    {{gmdate('i:s', (int) $product['sessionDuration'])}}
                                                </x-filament::badge>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </div>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-right: 10px;">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="table-layout: fixed;">
                                <colgroup>
                                    <col style="width: 60%;">
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                </colgroup>
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-2">
                                            Summary
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                {{$productDatas->sum('screenPageViews')}}
                                            </div>
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                {{gmdate('i:s', (int) $productDatas->avg('sessionDuration'))}}
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
        <div style="height: 500px;">
            @if ($isShowChartProduct == 'daily')
                <div style="margin-bottom: 5px;">
                    @livewire(\App\Livewire\ProductViewChart::class, [
                        'start_date' => $start_date,
                        'end_date' => $end_date
                    ])
                </div>
            @elseif ($isShowChartProduct == 'monthly')
                <div style="margin-bottom: 5px;">
                    @livewire(\App\Livewire\ProductViewChartMonthly::class, [
                        'start_date' => $start_date,
                        'end_date' => $end_date
                    ])
                </div>
            @endif
            <div style="margin-bottom: 5px; text-align: center">
                <x-filament::button size="xs" color="gray" wire:click="showChartProduct('daily')">
                    Daily
                </x-filament::button>
                <x-filament::button size="xs" color="gray" wire:click="showChartProduct('monthly')">
                    Monthly
                </x-filament::button>
            </div>
        </div>
        <div>
            <div style="height: 500px" class="fi-wi-stats-overview-card relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5">
                <div class="grid gap-y-4">
                    <div class="flex items-center justify-between gap-x-2">
                        <div>
                            <span class="text-lg font-semibold text-gray-500 dark:text-gray-100">
                                News Page Visitors
                            </span>
                            <br>
                            <span class="text-sm font-semibold text-gray-400 dark:text-gray-100">
                                Jumlah pengunjung per news (berita)
                            </span>
                        </div>
                        <div>
                            {{$this->searchNews}}
                        </div>
                    </div>
                
                    <div class="relative">
                        <div style="margin-right: 10px;">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="table-layout: fixed;">
                                <colgroup>
                                    <col style="width: 60%;">
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                </colgroup>
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-3 py-2">
                                            News Title
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
                        <div style="height: 270px;" class="overflow-y-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="table-layout: fixed;">
                                <colgroup>
                                    <col style="width: 60%;">
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                </colgroup>
                                <tbody>
                                    @foreach ($newsDatas as $news)
                                        <tr class="bg-white border-b border-gray-200">
                                            <td scope="row" class="px-3 py-2 font-medium text-gray-900">
                                                <a href="{{env('APP_URL').$news['pagePath']}}" target="_blank">
                                                    {{$news['newsTitle']}}
                                                </a>
                                            </td>
                                            <td class="px-3 py-2">
                                                <x-filament::badge class="tabular-nums shrink-0" size="xs">
                                                    {{$news['screenPageViews']}}
                                                </x-filament::badge>
                                            </td>
                                            <td class="px-3 py-2">
                                                <x-filament::badge class="tabular-nums shrink-0" color="success" size="xs">
                                                    {{gmdate('i:s', (int) $news['sessionDuration'])}}
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
                                    <col style="width: 60%;">
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                </colgroup>
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-3 py-2">
                                            Summary
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                {{$newsDatas->sum('screenPageViews')}}
                                            </div>
                                        </th>
                                        <th scope="col" class="px-3 py-2">
                                            <div class="text-center">
                                                {{gmdate('i:s', (int) $newsDatas->avg('sessionDuration'))}}
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
