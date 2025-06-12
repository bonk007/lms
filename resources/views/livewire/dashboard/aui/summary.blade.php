<div class="grid grid-cols-4 gap-4">
    <div class="flex flex-col justify-center items-center p-4 rounded shadow text-gray-50 bg-blue-600">
        <span>Jumlah Partisipan</span>
        <span class="font-bold text-3xl">{{ $data->get('total') }}</span>
    </div>
    <div class="flex flex-col justify-center items-center p-4 rounded shadow text-gray-50 bg-green-600">
        <span>Beban Rendah</span>
        <span class="font-bold text-3xl">{{ $data->get('low') }}</span>
    </div>
    <div class="flex flex-col justify-center items-center p-4 rounded shadow text-gray-50 bg-yellow-600">
        <span>Beban Sedang</span>
        <span class="font-bold text-3xl">{{ $data->get('medium') }}</span>
    </div>
    <div class="flex flex-col justify-center items-center p-4 rounded shadow text-gray-50 bg-red-600">
        <span>Beban Tinggi</span>
        <span class="font-bold text-3xl">{{ $data->get('high') }}</span>
    </div>
</div>
