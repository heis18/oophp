<?php

namespace Heis\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "INDEX!";
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function initAction() : object
    {
        // Init the session too start the game.
        $game = new DiceBoard();
        $this->app->session->set("game", $game);

        return $this->app->response->redirect("dice1/play");
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function playAction() : object
    {
        $title = "Play the game (1)";
        $board = $this->app->session->get("game", new DiceBoard());

        $data = [
            "board" => $board,
        ];

        $this->app->page->add("dice1/play", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function rollAction() : object
    {
        $board = $this->app->session->get("game");

        if ($board == null) {
            return $this->app->response->redirect("dice1/init");
        }

        $player = $board->getPlayer1();

        $hand = new DiceHand();
        $hand->roll();

        $player->currentHand()->addHandToHand($hand);

         //if player has won, the result is saved in the table
        if ($player->hasWon($player->currentHand())) {
            $player->addHandToList($player->currentHand());
        }

        return $this->app->response->redirect("dice1/play");
    }




    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function nextAction() : object
    {
        $board = $this->app->session->get("game");

        if ($board == null) {
            return $this->app->response->redirect("dice1/init");
        }

        $currentPlayer = $board->getCurrentPlayer();
        $board->nextPlayer();

          // get to next round computer rolled his dices
        if ($currentPlayer == $board->getComputer()) {
            $board->nextRound();

          // when player1 activate"next"
          // we roll the dices for the computer
        } else {
            $board->playComputer();
        }

        return $this->app->response->redirect("dice1/play");
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game";
    }
}
