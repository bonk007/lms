<?php

namespace App\Livewire\Dashboard;

use App\Jobs\MakeCsv;
use App\Livewire\Traits\HasAlert;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Livewire\Component;

class EyeTrackerDownloader extends Component
{
    use HasAlert;


    public function download(): void
    {
        DB::table('gazer_records')
            ->distinct()
            ->select('user_id')
            ->orderBy('user_id')
            ->each(function (\stdClass $obj) {
                MakeCsv::dispatch($obj->user_id);
//                (new MakeCsv($obj->user_id))
            });

        $this->success('Job dispatched');
    }

    public function render(): View
    {
        return view('livewire.dashboard.eye-tracker-downloader');
    }
}
