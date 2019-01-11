<?php
/**
 * Created by PhpStorm.
 * User: maksymiliankowalewski
 * Date: 10/01/2019
 * Time: 19:52
 */

namespace App\Services;


use App\Interfaces\GameParams;

class Game implements GameParams
{

    private $results = [];


    private function Run()
    {
        return $this->create(self::Lines);
    }

    private function create(int $lines = 3)
    {
        $result = [];
        for($i = 0; $i < $lines; $i++){

            $line = array_random(self::Keys, 5);
            $result[] = $line;
        }

        return $this->createMapBoardFrom(array_merge(...$result));
    }

    private function reroll(array $a , int $i , int $j):array
    {
        $tmp =  $a[$i];
        if ($i > $j)
        {
            for ($k = $i; $k > $j; $k--) {
                $a[$k] = $a[$k-1];
            }
        }
        else
        {
            for ($k = $i; $k < $j; $k++) {
                $a[$k] = $a[$k+1];
            }
        }
        $a[$j] = $tmp;
        return $a;
    }




    private function createMapBoardFrom(array $lines)
    {
        $reloadLines = $this->reroll($lines, 5,1);
        $Board = array_combine(self::Map, $reloadLines);
        $BoardLines = array_chunk($Board,5,true);
        $RecursiveLines = [
            'UP' => [
                0 => $Board[0],
                4 => $Board[4],
                8 => $Board[8],
                10 => $Board[10],
                12 => $Board[12]
            ],
            'Down' => [
                2 => $Board[2],
                4 => $Board[4],
                6 => $Board[6],
                10 => $Board[10],
                13 => $Board[13]
            ]
        ];

        $result = array_merge($BoardLines, $RecursiveLines);
        $this->findMatchesOn($result);
    }

    private function setResults(array $array)
    {
        $this->results = $array;
    }


    private function findMatchesOn(array $board)
    {

        /** TODO: refactor this */
        $results=[];

       foreach ($board as $lines)
       {
           foreach ($lines as $key => $value){

               $val = count(array_keys($lines, $value,true));

               if($val >= 3)
               {
                   $wins += [$board,$val];
               }

               $results += [$board,$val];
           }
       }

        return $this->setResult($results);
    }


    public function generateTableView(int $amount)
    {
        $wins =[];

        for($i = 0; $i < $amount; $i++)
        {
            $this->Run();

            $wins[] = $this->wins;
        }

        return dd($wins);

    }



    //if 3 === $


    // 3 symbols = 20% 4 = 200% 5 = 1000%

//board: [0,....,14]
//• paylines: Array with matched payline and number of matched symbol.
//• bet_amount: monetary numbers in cents 1€ = 100cents. In you case is always 100
//• total_win: amount won.

//board: [J, J, J, Q, K, cat, J, Q, monkey, bird, bird, bird, J, Q, A],
//paylines: [{"0 3 6 9 12": 3}, {"0 4 8 10 12":3}],
//bet_amount: 100,
//total_win: 40,


}