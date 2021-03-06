<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 */
class Game
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


    /**
     * @ORM\ManyToOne(targetEntity="DecisionType")
     * @ORM\JoinColumn(name="opponent_decision_type_id", referencedColumnName="id")
     */
    protected $opponentDecision;

    /**
     * @ORM\ManyToOne(targetEntity="DecisionType")
     * @ORM\JoinColumn(name="computer_decision_type_id", referencedColumnName="id")
     */
    protected $computerDecision;

    /**
     * @ORM\ManyToOne(targetEntity="GameState")
     * @ORM\JoinColumn(name="game_state_id", referencedColumnName="id")
     */
    protected $state;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Game
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * Set opponents DecisionType
     *
     * @param DecisionType $decision
     *
     * @return Game
     */
    public function setOpponentDecision(DecisionType $decision)
    {
        $this->opponentDecision = $decision;

        return $this;
    }

    /**
     * Get opponent's DecisionType
     *
     * @return DecisionType
     */
    public function getOpponentDecision()
    {
        return $this->opponentDecision;
    }

    /**
     * Set computer's DecisionType
     *
     * @param DecisionType $decision
     *
     * @return Game
     */
    public function setComputerDecision(DecisionType $decision)
    {
        $this->computerDecision = $decision;

        return $this;
    }

    /**
     * Get computers's DecisionType
     *
     * @return DecisionType
     */
    public function getComputerDecision()
    {
        return $this->computerDecision;
    }

    /**
     * Set computer's DecisionType
     *
     * @param GameState $gameState
     *
     * @return Game
     */
    public function setState(GameState $gameState)
    {
        $this->state = $gameState;

        return $this;
    }

    /**
     * Return's the state of the game
     *
     * @return GameState
     */
    public function getState()
    {
        return $this->state;
    }
}
