<?php
/**
 * Created by PhpStorm.
 * User: maksymiliankowalewski
 * Date: 10/01/2019
 * Time: 19:05
 */

namespace App\Console\Commands;


use App\Services\GameHandler;
use Exception;
use Illuminate\Console\Command;



class startGame extends Command
{


    protected $signature = "game:start";

    protected $description = "game:start amount of money";



    public function handle(GameHandler $handler)
    {
        try {


            $amount = $this->ask('What amount you want to bet?');

            if ($amount > 0) {
                $game = $handler->playGame($amount);

                $results = json_encode($game);

                $this->info($results);
            }

            else
                {
                    $this->info('Please provide Euro amount: minimum 1');
                }





        } catch (Exception $e) {
            $this->error("An error occurred");
        }
    }

}