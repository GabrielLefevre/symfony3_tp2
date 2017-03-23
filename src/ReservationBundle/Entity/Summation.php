<?php

namespace ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Summation
 *
 * @ORM\Table(name="summation")
 * @ORM\Entity(repositoryClass="ReservationBundle\Repository\SummationRepository")
 */
class Summation
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
     * @var \stdClass
     *
     * @ORM\Column(name="package", type="object")
     *
     * @ORM\ManyToOne(targetEntity="ReservationBundle\Entity\Package")
     * @ORM\JoinColumn(name="package", referencedColumnName="id")
     */
    private $package;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="season", type="object")
     *
     * @ORM\ManyToOne(targetEntity="ReservationBundle\Entity\Season")
     * @ORM\JoinColumn(name="season", referencedColumnName="id")
     */
    private $season;


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
     * Set package
     *
     * @param \stdClass $package
     *
     * @return Summation
     */
    public function setPackage($package)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \stdClass
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Set season
     *
     * @param \stdClass $season
     *
     * @return Summation
     */
    public function setSeason($season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Get season
     *
     * @return \stdClass
     */
    public function getSeason()
    {
        return $this->season;
    }
}

