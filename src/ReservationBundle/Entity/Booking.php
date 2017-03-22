<?php

namespace ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="ReservationBundle\Repository\BookingRepository")
 */
class Booking
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="summation", type="object")
     *
     * @ORM\OneToOne(targetEntity="ReservationBundle\Entity\Summation")
     * @ORM\JoinColumn(name="summation", referencedColumnName="id")
     */
    private $summation;


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
     * @return Booking
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
     * Set summation
     *
     * @param \stdClass $summation
     *
     * @return Booking
     */
    public function setSummation($summation)
    {
        $this->summation = $summation;

        return $this;
    }

    /**
     * Get summation
     *
     * @return \stdClass
     */
    public function getSummation()
    {
        return $this->summation;
    }
}

