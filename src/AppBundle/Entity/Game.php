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
     * @return int
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
     * @return int
     */
    public function getComputerDecision()
    {
        return $this->opponentDecision;
    }

    /**
     * Evaluates the opponent's choice against the computers.
     */
    public function evaluate() 
    {
        return true;
    }
}
