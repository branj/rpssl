<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * DecisionType
 *
 * @ORM\Table(name="decision_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DecisionTypeRepository")
 */
class DecisionType
{
    /**
     * @var Decision type of Rock
     */
    const ROCK = 1;

    /**
     * @var Decision type of Paper
     */
    const PAPER = 2;

    /**
     * @var Decision type of Scissors
     */
    const SCISSORS = 3;

    /**
     * @var Decision type of Spock
     */
    const SPOCK = 4;

    /**
     *  @var Decision type of Lizard
     */
    const LIZARD = 5;

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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity="Game", mappedBy="opponentDecision")
     */
    private $opponetDecisions;

    /**
     * @ORM\OneToMany(targetEntity="Game", mappedBy="opponentDecision")
     */
    private $computerDecisions;

    /**
     * Ensure we set up the mapping correctly.
     */
    public function __construct()
    {
        $this->opponetDecisions = new ArrayCollection();
        $this->computerDecisions = new ArrayCollection();
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
     * @return DecisionType
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
