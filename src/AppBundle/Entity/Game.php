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
     * @ORM\Column(name="game_state_id", type="integer")
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
     * @ORM\Column(name="_decision_type_id", type="integer")
     */
    private $computerDecisionTypeId;

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
}

