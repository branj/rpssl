<?php
namespace AppBundle\Service;

use AppBundle\Entity\Game;
use AppBundle\Entity\GameState;
use AppBundle\Entity\DecisionType;

/**
 * This class houses all the game logic (ie. Who wins). This would be a good place to put more advanced
 * algorithms for determining what decision the computer makes next.
 */
class GameLogic
{

    /**
     * Returns a GameState.id entity based on it's configuration
     * @param  Game   $game The game to evaluate
     * @return int  The GameState.id result.
     */
    public static function run(Game $game)
    {
        return self::runDecisions($game->getOpponentDecision(), $game->getComputerDecision());
    }

    /**
     * Takes two decisions and returns the game state based off of Player 1
     * @param  DecisionType $opponent In this corner we have the user
     * @param  DecisionType $computer In this corner we have the computer, we call him Balmer
     * @return int Return a GameState.id
     */
    public static function runDecisions(DecisionType $opponent, DecisionType $computer)
    {
        $stateId = GameState::UNRESOLVED;

        if ($opponent->getId() == $computer->getId()) {
            $stateId = GameState::DRAW;
        } elseif (in_array($computer->getId(), self::getLogicArray()[$opponent->getId()])) {
            $stateId = GameState::OPPONENT_WON;
        } else {
            $stateId = GameState::COMPUTER_WON;
        }

        return $stateId;
    }

    /**
     * Returns a 2 dimensional decision matrix to determine the winner.
     * @return Array An array indexed by DecisionType.id
     */
    public static function getLogicArray()
    {
        return
        [
            DecisionType::ROCK => [DecisionType::SCISSORS, DecisionType::LIZARD],
            DecisionType::PAPER => [DecisionType::ROCK, DecisionType::SPOCK],
            DecisionType::SCISSORS => [DecisionType::PAPER, DecisionType::LIZARD],
            DecisionType::LIZARD => [DecisionType::SPOCK, DecisionType::PAPER],
            DecisionType::SPOCK => [DecisionType::SCISSORS, DecisionType::ROCK],
        ];
    }

    /**
     * Returns a random DecisionType.id
     */
    public static function getRandomDecision()
    {
        return array_rand(self::getLogicArray(), 1);
    }
}
