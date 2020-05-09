<?php

use Lib\Entity\Eu;

use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    public function testCountryEu()
    {
        $entity = new Eu;
        $this->assertTrue($entity->isCountryEu('SE'));
    }

    public function testIsYesOrNo()
    {
        $entity = new Eu;
        $entity->isCountryEu('SE');
        $this->assertEquals($entity->getYesOrNo(), "yes");
    }

}