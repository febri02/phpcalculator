<?php

namespace Src\Helpers;

use Illuminate\Support\Carbon;
use Storage;

class Calculator
{
    public static function getHasil($operator,array $numbers)
    {
        $hasil = [];

        $hasil['description'] = Calculator::generateCalculationDescription($operator,$numbers);
        $hasil['result'] = Calculator::calculateAll($operator,$numbers);
        Calculator::logs($operator,$hasil['description'],$hasil['result']);

        return $hasil;
    }

    public static function generateCalculationDescription($opr,array $numbers): string
    {
        $operator = Calculator::getOperator($opr);
        $glue = sprintf(' %s ', $operator);

        return implode($glue, $numbers);
    }

    public static function getOperator($operator): string
    {
        $hasil = '';
        if($operator=='add'){
            $hasil = '+';
        }
        else if($operator=='subtract'){
            $hasil = '-';
        }
        else if($operator=='multiply'){
            $hasil = '*';
        }
        else if($operator=='divide'){
            $hasil = '/';
        }
        else if($operator=='pow'){
            $hasil = '^';
        }

        return $hasil;
    }

    /**
     * @param array $numbers
     *
     * @return float|int
     */
    public static function calculateAll($operator,array $numbers)
    {
        $number = array_pop($numbers);

        if (count($numbers) <= 0) {
            return $number;
        }

        return Calculator::calculate($operator,Calculator::calculateAll($operator,$numbers), $number);
    }

    /**
     * @param int|float $number1
     * @param int|float $number2
     *
     * @return int|float
     */
    public static function calculate($operator,$number1, $number2)
    {
        if($operator=='add'){
            $hasil = $number1 + $number2;
        }
        else if($operator=='subtract'){
            $hasil = $number1 - $number2;
        }
        else if($operator=='multiply'){
            $hasil = $number1 * $number2;
        }
        else if($operator=='divide'){
            $hasil = $number1 / $number2;
        }
        else if($operator=='pow'){
            $hasil = pow($number1, $number2);
        }

        return $hasil;
    }

    public static function logs($operator,$description,$result)
    {
        $logs = [];
        $detail_log = (object)[
            'command'=> $operator,
            'description'=> $description,
            'result' => $result,
            'output' => sprintf('%s = %s', $description, $result),
            'time' => Carbon::parse(Carbon::now('Asia/Jakarta'))->format('Y-m-d h:i:s')
        ];

        if(Storage::exists('logs.json')){
            $logs = json_decode(Storage::get('logs.json'));
            array_push($logs,json_encode($detail_log));
            Storage::delete('logs.json');
        }
        else{
            array_push($logs, json_encode($detail_log));
        }

        Storage::put('logs.json', json_encode($logs));
    }

}

?>
