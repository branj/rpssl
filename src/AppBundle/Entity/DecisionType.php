<?php

namespace AppBundle\Entity;

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

    /**
     * Though we have this in the DB we still want to enforce the choices as the logic of DecisionType is somewhat ridgid.
     * @return  int The number of choices
     */
    public static function numberOfDecisions()
    {
        return count([
            self::ROCK,
            self::PAPER,
            self::SCISSORS,
            self::SPOCK,
            self::LIZARD,
        ]);
    }
}

