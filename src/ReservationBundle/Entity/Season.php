<?php

namespace ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Season
 *
 * @ORM\Table(name="season")
 * @ORM\Entity(repositoryClass="ReservationBundle\Repository\SeasonRepository")
 */
class Season
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="increase", type="float")
     */
    private $increase;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="period", type="object")
     *
     * @ORM\OneToMany(targetEntity="ReservationBundle\Entity\Period", mappedBy="season")
     */
    private $period;


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
     * @return Season
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
     * Set increase
     *
     * @param float $increase
     *
     * @return Season
     */
    public function setIncrease($increase)
    {
        $this->increase = $increase;

        return $this;
    }

    /**
     * Get increase
     *
     * @return float
     */
    public function getIncrease()
    {
        return $this->increase;
    }

    /**
     * Set period
     *
     * @param \stdClass $period
     *
     * @return Season
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return \stdClass
     */
    public function getPeriod()
    {
        return $this->period;
    }
}

