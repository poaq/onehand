<?php
/**
 * Created by PhpStorm.
 * User: maksymiliankowalewski
 * Date: 11/01/2019
 * Time: 03:03
 */

namespace App\Services;


class User
{

    private $name;

    private $games;

    private $money;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getGames()
    {
        return $this->games;
    }

    /**
     * @param mixed $games
     */
    public function setGames($games): void
    {
        $this->games = $games;
    }

    /**
     * @return mixed
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * @param mixed $money
     */
    public function setMoney($money): void
    {
        $this->money = $money;
    }


}