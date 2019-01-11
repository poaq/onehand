<?php
/**
 * Created by PhpStorm.
 * User: maksymiliankowalewski
 * Date: 11/01/2019
 * Time: 03:05
 */

namespace App\Services;

use App\Services\Game;


class GameHandler
{
    /**
     * @var Game
     */
    private $game;


    public function __construct
    (
        Game $game
    )
    {
        $this->game = $game;
    }



    public function playGame($bet)
    {
        return $this->game->playGame($bet);
    }

//    public function play($multiple)
//    {
//        return $this->game->playMultipleGames($multiple);
//    }


}