<?php

namespace Src\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\Console\Input\ArrayInput;
use Storage;

class HistoryCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'history:list {--commands*}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Show calculator history';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(Storage::exists('logs.json')){
            $dataHistory = Storage::get('logs.json');
            if(count(json_decode($dataHistory))*1==0){
                $this->info('History is empty.');
            }
            else{
                $logs = [];
                $rows = [];
                for($i=0;$i<count(json_decode($dataHistory));$i++){
                    $rows[$i] = array_merge(
                                        ['no'=>$i+1],
                                        (array) json_decode(json_decode($dataHistory,true)[$i])
                                    );
                    array_push($logs,json_encode($rows[$i]));
                }

                $stream = fopen('php://output', 'w');
                $output = new StreamOutput($stream);

                $table = new Table($output);
                $table->setHeaders(['No','Command','Description','Result','Output','Time']);
                $table->addRows($rows);

                $table->render();
            }
        }
        else{
            $this->info('History is empty.');
        }
    }
}
