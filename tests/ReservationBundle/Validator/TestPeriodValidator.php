<?php

/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 24/03/2017
 * Time: 13:25
 */
namespace ReservationBundle\tests\Validator\Constraints;

use ReservationBundle\Entity\Period;
use ReservationBundle\Validator\Constraints\PeriodValidator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestPeriodValidator extends WebTestCase
{
    public function testValidDateDepartCourantComprisEntreDateDepartDateFin() {
        $mokEm = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $periodValidator = new PeriodValidator($mokEm);

        $dateDepartCourante = new \DateTime('2017-01-12');
        $dateFinCourante = new \DateTime('2017-02-01');

        $mokPeriodCourante = $this->getMockBuilder('ReservationBundle\Entity\Period')
            ->getMock();

        $mokPeriodCourante->expects($this->any())
            ->method('getStart')
            ->will($this->returnValue($dateDepartCourante));
        $mokPeriodCourante->expects($this->any())
            ->method('getEnd')
            ->will($this->returnValue($dateFinCourante));

        $tabPeriods = array();

        $dateDepartPeriod1 = new \DateTime('2017-01-01');
        $dateFinPeriod1 = new \DateTime('2017-01-20');

        $mokPeriod1 = $this->getMockBuilder('ReservationBundle\Entity\Period')
            ->getMock();

        $mokPeriod1->expects($this->any())
            ->method('getStart')
            ->will($this->returnValue($dateDepartPeriod1));
        $mokPeriod1->expects($this->any())
            ->method('getEnd')
            ->will($this->returnValue($dateFinPeriod1));


        $dateDepartPeriod2 = new \DateTime('2017-01-15');
        $dateFinPeriod2 = new \DateTime('2017-01-31');

        $mokPeriod2 = $this->getMockBuilder('ReservationBundle\Entity\Period')
            ->getMock();

        $mokPeriod2->expects($this->any())
            ->method('getStart')
            ->will($this->returnValue($dateDepartPeriod2));
        $mokPeriod2->expects($this->any())
            ->method('getEnd')
            ->will($this->returnValue($dateFinPeriod2));

        array_push($tabPeriods, $mokPeriod1,$mokPeriod2);

        $result = $periodValidator->validDate($tabPeriods, $mokPeriodCourante);

        $this->assertEquals(false,$result);
    } // testValidDateDepartCourantComprisEntreDateDepartDateFin





    public function testValidDateFinCourantComprisEntreDateDepartDateFin() {
       $mokEm = $this->mokEm();
        $periodValidator = new PeriodValidator($mokEm);
        $mokPeriodCourante = $this->mokerPeriod('2017-01-15', '2017-01-25');
        $mokPeriod1 = $this->mokerPeriod('2017-01-20','2017-01-28');
        $mokPeriod2 = $this->mokerPeriod('2017-01-29','2017-01-30');
        $tabPeriods = array();
        array_push($tabPeriods, $mokPeriod1,$mokPeriod2);

        $result = $periodValidator->validDate($tabPeriods, $mokPeriodCourante);

        $this->assertEquals(false,$result);


    } // testValidDateFinCourantComprisEntreDateDepartDateFin

    public function testValidDateDepartComprisEntreDateDepartcourantDateFinCourant() {
        $mokEm = $this->mokEm();
        $periodValidator = new PeriodValidator($mokEm);
        $mokPeriodCourante = $this->mokerPeriod('2017-01-15', '2017-01-25');
        $mokPeriod1 = $this->mokerPeriod('2017-01-18','2017-01-22');
        $mokPeriod2 = $this->mokerPeriod('2017-01-25','2017-01-30');
        $tabPeriods = array();
        array_push($tabPeriods, $mokPeriod1,$mokPeriod2);

        $result = $periodValidator->validDate($tabPeriods, $mokPeriodCourante);

        $this->assertEquals(false,$result);
    }

    public function testValidDateOK() {
        $mokEm = $this->mokEm();
        $periodValidator = new PeriodValidator($mokEm);
        $mokPeriodCourante = $this->mokerPeriod('2017-01-15', '2017-01-25');
        $mokPeriod1 = $this->mokerPeriod('2017-01-10','2017-01-14');
        $mokPeriod2 = $this->mokerPeriod('2017-01-26','2017-01-30');
        $tabPeriods = array();
        array_push($tabPeriods, $mokPeriod1,$mokPeriod2);

        $result = $periodValidator->validDate($tabPeriods, $mokPeriodCourante);

        $this->assertEquals(false,$result);
    }

    private function mokerPeriod( $date1,  $date2) {
        $depart = new \DateTime($date1);
        $fin = new \DateTime($date2);
        $mokPeriod = $this->getMockBuilder('ReservationBundle\Entity\Period')
            ->getMock();

        $mokPeriod->expects($this->any())
            ->method('getStart')
            ->will($this->returnValue($depart));
        $mokPeriod->expects($this->any())
            ->method('getEnd')
            ->will($this->returnValue($fin));

        return $mokPeriod;
    }

    private function mokEm() {
        return $mokEm = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();
    }
}