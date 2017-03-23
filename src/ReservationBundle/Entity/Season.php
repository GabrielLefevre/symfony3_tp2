<?php

namespace ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     *
     * @Assert\Type("string")
     * @Assert\NotBlank(message="not blank")
     * @Assert\Length(
     *     min=3,
     *     max=50,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.")
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="increase", type="float")
     *
     * @Assert\Type("float")
     *  @Assert\Range(
     *      min = -1000,
     *      max = 1000,
     *      minMessage = " min: {{ limit }} % ",
     *      maxMessage = "max: {{ limit }} %"
     * )
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

