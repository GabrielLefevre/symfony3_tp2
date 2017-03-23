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
     * @ORM\Column(name="season", type="object")
     *
     * @ORM\ManyToOne(targetEntity="ReservationBundle\Entity\Season")
     * @ORM\JoinColumn(name="season", referencedColumnName="id")
     */
    private $season;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     *
     * @Assert\Type("float")
     */
    private $price;


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

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }


}

