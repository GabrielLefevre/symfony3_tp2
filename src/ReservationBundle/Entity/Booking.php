<?php

namespace ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="datetime")
     *
     *  @Assert\DateTime()
     */
    private $datestart;

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
     * @var \stdClass
     *
     * @ORM\Column(name="package", type="object")
     *
     * @ORM\ManyToOne(targetEntity="ReservationBundle\Entity\Package")
     * @ORM\JoinColumn(name="package", referencedColumnName="id")
     */
    private $package;


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
     * @param \DateTime $datestart
     *
     * @return Booking
     */
    public function setDatestart($datestart)
    {
        $this->datestart = $datestart;

        return $this;
    }

    /**
     * Get datestart
     *
     * @return \DateTime
     */
    public function getDatestart()
    {
        return $this->datestart;
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

    /**
     * @return \stdClass
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param \stdClass $package
     */
    public function setPackage($package)
    {
        $this->package = $package;
    }


}

