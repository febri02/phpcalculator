<?php

namespace Sr\Commands;

use Symfony\Component\Console\Command\Command;
use Src\Helpers\Calculator;

class PowCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'pow {base} {exp}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Exponent the given Numbers';

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
        $numbers = [$this->argument('base'),$this->argument('exp')];
        $hasil = $this->calculator->getHasil('pow',$numbers);
        $this->comment(sprintf('%s = %s', $hasil['description'], $hasil['result']));
    }
}
