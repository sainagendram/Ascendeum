<?php 
include_once('players.php');
include_once('board.php');
class Game{
    private $board;
    private $winner;
    private $players;

    public function __construct($board,$players)
    {
        $this->board = $board;
        foreach ($players as $player) {
            
            $this->players [] = new Players($player);
        }
    }

    public function rollDice(){
        return rand(1,6);
    }

    public function Play(){

        $players_vs_dices = [];
        while(!$this->winner){

            foreach ($this->players as $player) {
                
                if($this->winner) break;

                $dice = $this->rollDice();

                $player->move($dice);

                $players_vs_dices[] = ['player'=>$player->getName(),'dice'=>$dice,'position_history' =>$player->getPosition() ,'winner'=>$this->winner];
               // echo "Rolling Dice for {$player->getName()} and dice number is $dice and is in Position of {$player->getPosition()} <br />";


                if($player->getPosition() > $this->board->getSize()){
                    $this->winner = $player->getName();
                    $players_vs_dices[] = ['player'=>$player->getName(),'dice'=>'', 'position_history' =>'' , 'winner'=>$this->winner];
                }
            }

        }

        return $players_vs_dices;
    }

}
