<?php

namespace ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Package
 *
 * @ORM\Table(name="package")
 * @ORM\Entity(repositoryClass="ReservationBundle\Repository\PackageRepository")
 */
class Package
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
     * @ORM\Column(name="timeunit", type="string", length=255)
     *
     * @Assert\Type("string")
     * @Assert\NotBlank(message="not blank")
     * @Assert\Length(
     *     min=3,
     *     max=40,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.")
     */
    private $timeunit;

    /**
     * @var int
     *
     * @ORM\Column(name="numberunit", type="integer")
     *
     * @Assert\Type("integer")
     * @Assert\NotNull()
     * @Assert\Range(
     *      min = 1,
     *      max = 25,
     *      minMessage = " min: {{ limit }}",
     *      maxMessage = "max: {{ limit }}"
     * )
     */
    private $numberunit;

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
     * Set timeunit
     *
     * @param string $timeunit
     *
     * @return Package
     */
    public function setTimeunit($timeunit)
    {
        $this->timeunit = $timeunit;

        return $this;
    }

    /**
     * Get timeunit
     *
     * @return string
     */
    public function getTimeunit()
    {
        return $this->timeunit;
    }

    /**
     * Set numberunit
     *
     * @param integer $numberunit
     *
     * @return Package
     */
    public function setNumberunit($numberunit)
    {
        $this->numberunit = $numberunit;

        return $this;
    }

    /**
     * Get numberunit
     *
     * @return int
     */
    public function getNumberunit()
    {
        return $this->numberunit;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Package
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    function __toString()
    {
        return $this->numberunit." ".$this->timeunit;
    }


}

