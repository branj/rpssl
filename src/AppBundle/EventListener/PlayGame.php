<?php

namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Game;
use AppBundle\Entity\GameState;
use AppBundle\Entity\DecisionType;
use AppBundle\Service\GameLogic;

/**
 * Listens for Game Doctrine events to handle playing the game.
 */
class PlayGame
{
    /**
     * Ensures the game date, computer decision, and state of he Game is set properly.
     * @param  LifecycleEventArgs $args [description]
     * @return void
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $game = $args->getObject();

        // only act on some "Game" entity
        if (!$game instanceof Game) {
            return;
        }

        //Let's get a random decision for the computer.
        $em = $args->getEntityManager();
        $decision = $em->getRepository(DecisionType::class)->find(GameLogic::getRandomDecision());

        //Set the computer decision
        $game->setComputerDecision($decision);
        $game->setCreatedAt(new \DateTime());

        //Let the logic Service give us a judgement.
        $gameStateId = GameLogic::run($game);
        $gameState = $em->getRepository(GameState::class)->find($gameStateId);
        $game->setState($gameState);
    }
}
