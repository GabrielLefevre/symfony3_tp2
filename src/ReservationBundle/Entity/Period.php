<?php

namespace ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Period
 *
 * @ORM\Table(name="period")
 * @ORM\Entity(repositoryClass="ReservationBundle\Repository\PeriodRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Period
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
     * @ORM\Column(name="start", type="datetime")
     *
     *  @Assert\DateTime()
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime")
     *
     * @Assert\DateTime()
     */
    private $end;


    /**
     *@ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Type("string")
     * @Assert\NotBlank(message="not blank")
     */
    private $stringPeriod;

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
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Period
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return Period
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @return mixed
     */
    public function getStringPeriod()
    {
        return $this->stringPeriod;
    }

    /**
     * @param mixed $stringPeriod
     */
    public function setStringPeriod($stringPeriod)
    {
        $this->stringPeriod = $stringPeriod;
    }



    /**
     * @ORM\PrePersist
     */
    public function convert() {
        $this->stringPeriod = $this->start->format('Y/m/d H:i')." ".$this->end->format('Y/m/d H:i');
    }

}

