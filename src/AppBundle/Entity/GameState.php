<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * GameState
 *
 * @ORM\Table(name="game_state")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameStateRepository")
 */
class GameState
{
    /**
     * @var int The id that represent the game has yet to be evaluated.
     */
    const UNRESOLVED = 1;

    /**
     * @var int The id that represent the game has been evaluated and the opponenet won.
     */
    const OPPONENT_WON = 2;

    /**
     * @var int The id that represent the game has been evaluated and the computer won.
     */
    const COMPUTER_WON = 3;

    /**
     * @var int The id that represent the game has been evaluated and was a draw.
     */
    const DRAW = 4;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Game", mappedBy="state")
     */
    private $games;

    /**
     * Ensure we set up the mapping correctly.
     */
    public function __construct()
    {
        $this->games = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return GameState
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Is this a win?
     * @return  bool True if this is a win, False if not
     */
    public function isAWin()
    {
        return $this->getId() == self::OPPONENT_WON;
    }

    /**
     * Is this a loss (computer won)?
     * @return  bool True if this is a loss, False if not
     */
    public function isALoss()
    {
        return $this->getId() == self::COMPUTER_WON;
    }

    /**
     * Is this a draw?
     * @return  bool True if this is a draw, False if not
     */
    public function isADraw()
    {
        return $this->getId() == self::DRAW;
    }

    /**
     * Is this unresolved?
     * @return  bool True if this is unresolved, False if not
     */
    public function isUnresolved()
    {
        return $this->getId() == self::UNRESOLVED;
    }
}
