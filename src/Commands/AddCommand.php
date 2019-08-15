<?php

namespace Src\Commands;

use Symfony\Component\Console\Command\Command;
use Src\Helpers\Calculator;

class AddCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'add {numbers*}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Add all given Numbers';

    protected $calculator;

    public function __construct(){
        parent::__construct();
        $this->calculator = new Calculator();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $numbers = $this->argument('numbers');
        $hasil = $this->calculator->getHasil('add',$numbers);
        $this->comment(sprintf('%s = %s', $hasil['description'], $hasil['result']));
    }
}
