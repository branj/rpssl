<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}

