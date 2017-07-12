<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var int
     *
     * @ORM\Column(name="game_state_id", type="integer", options={"default" : 1})
     */
    private $gameStateId;

    /**
     * @var int
     *
     * @ORM\Column(name="opponent_decision_type_id", type="integer")
     */
    private $opponentDecisionTypeId;

    /**
     * @var int
     *
     * @ORM\Column(name="computer_decision_type_id", type="integer")
     */
    private $computerDecisionTypeId;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", options={"default" : null})
     */
    private $userId;

    /**
     * @ORM\OneToOne(targetEntity="DecisionType")
     * @ORM\JoinColumn(name="opponent_decision_type_id", referencedColumnName="id")
     */
    protected $opponentDecision;

    /**
     * @ORM\OneToOne(targetEntity="DecisionType")
     * @ORM\JoinColumn(name="computer_decision_type_id", referencedColumnName="id")
     */
    protected $computerDecision;

    /**
     * @ORM\OneToOne(targetEntity="GameState")
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
     * Set gameStateId
     *
     * @param integer $gameStateId
     *
     * @return Game
     */
    public function setGameStateId($gameStateId)
    {
        $this->gameStateId = $gameStateId;

        return $this;
    }

    /**
     * Get gameStateId
     *
     * @return int
     */
    public function getGameStateId()
    {
        return $this->gameStateId;
    }

    /**
     * Retrieves the GameDecisionType Entity picked by the user.
     *
     * @return  GameDecisionType The Game Decision
     */
    public function getOpponentDecision()
    {
        return $this->opponentDecision;
    }

    /**
     * Retrieves the GameDecisionType Entity picked by the computer.
     *
     * @return  GameDecisionType The Game Decision Teypic
     */
    public function getComputerDecision()
    {
        return $this->computerDecision;
    }
}
