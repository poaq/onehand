<?php
/**
 * Created by PhpStorm.
 * User: maksymiliankowalewski
 * Date: 11/01/2019
 * Time: 03:05
 */

namespace App\Services;

use App\Services\Game;
use App\Services\User;

class GameHandler
{
    /**
     * @var Game
     */
    private $game;
    /**
     * @var User
     */
    private $user;

    public function __construct
    (
        Game $game,
        User $user
    )
    {
        $this->game = $game;
        $this->user = $user;
    }



}