<x-dashboard.layout>
    <div class="mt-4 mx-20 ">
        <livewire:dashboard.a-u-i.summary />
        <div class="mt-4">
            <div class="grid grid-cols-2 gap-4">
                <div x-data="{
                    init() {
                        console.log(Highcharts)
                    }
                }">
                    <livewire:dashboard.a-u-i.distribution-chart />
                </div>
                <div>
                    <h1 class="text-lg font-semibold mb-2">Tabel Ringkasan Partisipan</h1>
                    <livewire:dashboard.a-u-i.top-users-distribution />
                </div>
            </div>
        </div>
    </div>


</x-dashboard.layout>
