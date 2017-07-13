<?php

namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Game;
use AppBundle\Entity\GameState;
use AppBundle\Entity\DecisionType;

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

        $em = $args->getEntityManager();
        $decision = $em->getRepository(DecisionType::class)->find(rand(1, DecisionType::numberOfDecisions()));

        $game->setComputerDecision($decision);
        $game->setCreatedAt(new \DateTime());

        $objectManager = $args->getObjectManager();
    }
}