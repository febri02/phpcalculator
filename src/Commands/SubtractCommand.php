<?php

namespace Sr\Commands;

use Symfony\Component\Console\Command\Command;
use Src\Helpers\Calculator;

class SubtractCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'subtract {numbers*}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Subtract all given Numbers';

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
        $hasil = $this->calculator->getHasil('subtract',$numbers);
        $this->comment(sprintf('%s = %s', $hasil['description'], $hasil['result']));
    }
}
