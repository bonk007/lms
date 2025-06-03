<?php

namespace App\Console\Commands;

use App\Models\Resource;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class MakeSlideCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:slide';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        DB::transaction(function () {
            $user = $this->initiator();
            $resource = $this->resource($user);
            $slide = $this->createSlide($user);
            $resource->slides()->attach($slide);
        });
    }

    protected function createSlide(User $user): Slide
    {
        $slide = new Slide();
        $slide->user()->associate($user)->save();
        $items = [];

        for($i = 1; $i <= 24; $i++) {
//            $number = str_pad($i, 4, 0, STR_PAD_LEFT);
            $number = $i;
            $items[] = ["img" => "https://cdn.ibonk.id/01.%20Slide-20250603T011937Z-1-001/Slide".$number.".JPG"];
        }

        $slide->items()->createMany($items);

        $slide->publish();

        return $slide;
    }

    protected function initiator(): User
    {
        $id =select(
            label: 'Who will be a initiator?',
            options: User::query()->where('role_id', 'contributor')->pluck('name', 'id'),
            required: true
        );

        return throw_unless(User::find($id), \Exception::class, 'User with id '.$id.' was not found!');
    }

    protected function resource(User $creator): Resource
    {
        $id = select(
            label: 'Which is the resource?',
            options: Resource::query()->whereBelongsTo($creator, 'creator')->pluck('title', 'id'),
            required: true
        );

        return throw_unless(Resource::find($id), \Exception::class, 'Resource with id '.$id.' was not found!');
    }

}
