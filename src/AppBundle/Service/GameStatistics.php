<?php
namespace AppBundle\Service;

use AppBundle\Entity\Game;
use AppBundle\Entity\GameState;
use AppBundle\Entity\DecisionType;
use Symfony\Component\Cache\Simple\FilesystemCache;

/**
 * This class houses all the game statiscs logic. This is a great place to put statistic logic.
 */
class GameStatistics
{
    const STATISTIC_PREFIX = 'stats';
    const STATISTIC_OPPONENT_DRAW_PREFIX = 'opponent_draw';
    const STATISTIC_COMPUTER_DRAW_PREFIX = 'computer_draw';

    /**
     * Updates statistics with a games result
     * @param  Game   $game The game to evaluate
     * @return int  The GameState.id result.
     */
    public static function update(Game $game)
    {
        $stats = self::get();
        if (isset($stats[$game->getState()->getId()])) {
            $stats[$game->getState()->getId()]++;
        } else {
            $stats[$game->getState()->getId()] = 1;
        }

        if (isset($stats[self::STATISTIC_COMPUTER_DRAW_PREFIX][$game->getComputerDecision()->getId()])) {
            $stats[self::STATISTIC_COMPUTER_DRAW_PREFIX][$game->getComputerDecision()->getId()]++;
        } else {
            $stats[self::STATISTIC_COMPUTER_DRAW_PREFIX][$game->getComputerDecision()->getId()] = 1;
        }

        if (isset($stats[self::STATISTIC_OPPONENT_DRAW_PREFIX][$game->getOpponentDecision()->getId()])) {
            $stats[self::STATISTIC_OPPONENT_DRAW_PREFIX][$game->getOpponentDecision()->getId()]++;
        } else {
            $stats[self::STATISTIC_OPPONENT_DRAW_PREFIX][$game->getOpponentDecision()->getId()] = 1;
        }
        $cache = new FilesystemCache();
        $cache->set(self::STATISTIC_PREFIX, $stats);
    }

    /**
     * Retrieves cached item
     * @return returns the cached item.
     */
    public static function get()
    {
        $cache = new FilesystemCache();
         // retrieve the cache item
        if ($cache->has(self::STATISTIC_PREFIX)) {
            $stats = $cache->get(self::STATISTIC_PREFIX);
        } else {
            $stats = [];
        }

        return $stats;
    }

    /**
     * Gets the total number of wins
     * @param  boolean $includeOpponents Counts opponent wins
     * @param  boolean $includeComputer  Counts computer wins
     * @return int The number of wins
     */
    public static function getWins($includeOpponents = true, $includeComputer = true)
    {
        $number = 0;
        $stats = self::get();
        if ($includeOpponents && isset($stats[GameState::OPPONENT_WON])) {
            $number+= $stats[GameState::OPPONENT_WON];
        }
        if ($includeComputer && isset($stats[GameState::COMPUTER_WON])) {
            $number+= $stats[GameState::COMPUTER_WON];
        }
        return $number;
    }

    /**
     * Gets the total number of throws by types
     * @param  int     $decisionTypeId   The decision id to count.
     * @param  boolean $includeOpponents Counts opponent wins
     * @param  boolean $includeComputer  Counts computer wins
     * @return int The number of throws for given type
     */
    public static function getDecisions(int $decisionTypeId, $includeOpponents = true, $includeComputer = true)
    {
        $number = 0;
        $stats = self::get();
        if ($includeOpponents && isset($stats[self::STATISTIC_OPPONENT_DRAW_PREFIX][$decisionTypeId])) {
            $number+= $stats[self::STATISTIC_OPPONENT_DRAW_PREFIX][$decisionTypeId];
        }
        if ($includeComputer && isset($stats[self::STATISTIC_COMPUTER_DRAW_PREFIX][$decisionTypeId])) {
            $number+= $stats[self::STATISTIC_COMPUTER_DRAW_PREFIX][$decisionTypeId];
        }
        return $number;
    }
}
