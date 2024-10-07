<?php

namespace App\Console\Commands;

use App\Models\Instance;
use App\Models\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use function Laravel\Prompts\{form, select, text, textarea};

class CreateInstanceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:instance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create instance';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {

            $initiator = $this->initiator();

            $responses = form()
                ->text(label: 'What is the instance\'s name?', required: true, name: 'name')
                ->textarea(label: 'Describe the instance!', required: true, name: 'description')
                ->confirm(label: 'The data is correct?')
                ->submit();
            $initiator->initiatedInstances()->create($responses);
            $this->info('Instance with name `'.$responses['name'].'` was created!');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    protected function initiator(): User
    {
        $id = $this->option('user') ?? select(
            label: 'Who will be a initiator?',
            options: User::query()->where('role_id', 'contributor')->pluck('name', 'id'),
            required: true
        );

        return throw_unless(User::find($id), \Exception::class, 'User with id '.$id.' was not found!');
    }

    protected function getOptions(): array
    {
        return [
            ['user', null, InputOption::VALUE_REQUIRED, 'ID of a user who will be assigned as instance initiator']
        ];
    }
}
