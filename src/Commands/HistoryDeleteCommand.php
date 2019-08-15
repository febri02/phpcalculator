<?php

namespace Src\Commands;

use Symfony\Component\Console\Command\Command;
use Storage;

class HistoryDeleteCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'history:clear';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Clear calculator history';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(Storage::exists('logs.json')){
            Storage::delete('logs.json');
            $this->info('History clreared.');
        }
        else{
            $this->info('History is empty.');
        }
    }
}
