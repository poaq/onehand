<?php
/**
 * Created by PhpStorm.
 * User: maksymiliankowalewski
 * Date: 10/01/2019
 * Time: 19:05
 */

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Services\Game;

class startGame extends Command
{


    protected $signature = "game:start {amount : The amount of money you want to spent}";

    protected $description = "game:start amount of money";


    public function handle()
    {
        try {
            $amount = $this->argument('amount');

            $game = new Game();
            $result = $game->generateTableView($amount);

            if ($amount < 1) {
                $this->info("No money! Add amount of money in line. game:start {amount}");
                return;
            }

            $this->info($result);
        } catch (Exception $e) {
            $this->error("An error occurred");
        }
    }

}