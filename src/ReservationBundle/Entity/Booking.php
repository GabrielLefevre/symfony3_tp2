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
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="datetime")
     *
     *  @Assert\DateTime()
     */
    private $dateend;

    /**
     * @var float
     *
     * @ORM\Column(name="pricefinal", type="float")
     *
     */
    private $pricefinal;

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
     * @return \DateTime
     */
    public function getDateend()
    {
        return $this->dateend;
    }

    /**
     * @param \DateTime $dateend
     */
    public function setDateend($dateend)
    {
        $this->dateend = $dateend;
    }

    /**
     * @return float
     */
    public function getPricefinal()
    {
        return $this->pricefinal;
    }

    /**
     * @param float $pricefinal
     */
    public function setPricefinal($pricefinal)
    {
        $this->pricefinal = $pricefinal;
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

