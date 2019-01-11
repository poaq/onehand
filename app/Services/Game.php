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

    /**
     * @var array
     */
    private $data;

    /**
     * @var int
     */
    private $bet;


    private function Run()
    {
        return $this->create(self::Lines);
    }

    /**
     * @param int $lines
     * @return array
     */
    private function create(int $lines = 3)
    {
        $result = [];
        for($i = 0; $i < $lines; $i++){

            $line = array_random(self::Keys, 5);
            $result[] = $line;
        }

        return $this->createMapBoardFrom(array_merge(...$result));
    }

    /**
     * @param array $a
     * @param int $i
     * @param int $j
     * @return array
     */
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


    /**
     * @param array $lines
     * @return array
     */
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

        return $this->createDataForProcessing($result, $BoardLines);

    }

    private function createDataForProcessing(array $Board, array $BoardLines)
    {

        /** TODO: refactor on small parts */

        $wins = $this->findMatchesOn($Board);

        $reward = 0;

        $bet = $this->bet;

        if(count($wins) > 0) {
        $reward = $this->checkValue($wins['Count']);
        }

        $won = $this->CalculateWin($bet, $reward);

        $board['Board'] = array_merge(...$BoardLines);

        if(!$wins){

           $data = [
               [
                   self::Bet_amount => $bet,
                   self::Paylines => 0,
                   self::Total_win => $won,
                   self::Board => array_first($board)
               ]
           ];

           return $this->data = $data;
        }
        $Balance = [self::Total_win => $won];

        $part1 = array_merge($wins, $Balance, $board);
        $part2 = [self::Bet_amount => $bet];
        $data = [array_merge($part2, $part1)];

        return $this->data = $data;
    }


    private function CalculateWin(int $bet, int $rewardRatio): int
    {
        return $value = $bet * $rewardRatio;
    }

    private function checkValue(int $value)
    {
        switch($value)
        {
            default:
                return 0;
                break;
            case 3:
                return 0.2;
                break;
            case 4:
                return 2;
                break;
            case 5:
                return 10;
                break;
        }
    }

    /**
     * @param array $board
     * @return array
     */
    private function findMatchesOn(array $board): array
    {

        $data=[];

       foreach ($board as $lines)
       {
           foreach ($lines as $key => $value){

               $val = count(array_keys($lines, $value,true));

               if($val >= 3)
               {
                   $data += [self::Paylines => $lines, 'Count' => $val];
               }
           }
       }

       return $data;
    }

    private function centsFrom(int $euro): int
    {
        return $Cents = $euro * 100;
    }


    public function playGame(int $euro = 1): array
    {

        $this->bet = $this->centsFrom($euro);
        $this->Run();
        $result = $this->data;



        dd($result);
        return $result;
    }




//board: [J, J, J, Q, K, cat, J, Q, monkey, bird, bird, bird, J, Q, A],
//paylines: [{"0 3 6 9 12": 3}, {"0 4 8 10 12":3}],
//bet_amount: 100,
//total_win: 40,


}