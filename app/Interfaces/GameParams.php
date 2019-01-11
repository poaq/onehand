<?php
/**
 * Created by PhpStorm.
 * User: maksymiliankowalewski
 * Date: 10/01/2019
 * Time: 22:13
 */

namespace App\Interfaces;


interface GameParams
{

    const Keys = [9, 10, 'J', 'Q', 'K', 'A', 'cat', 'dog', 'monkey','bird'];
    const Map = [0, 3, 6, 9, 12, 1, 4, 7, 10, 13, 2, 5, 8, 11, 14];
    const Lines = 3;

    const Board = 'board';
    const Paylines = 'paylines';
    const Bet_amount = 'bet_amount:';
    const Total_win = 'total_win';


}