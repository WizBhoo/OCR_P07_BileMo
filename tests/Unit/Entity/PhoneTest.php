<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Tests\Unit\Entity;

use App\Entity\Phone;
use PHPUnit\Framework\TestCase;

/**
 * Class PhoneTest.
 */
class PhoneTest extends TestCase
{
    /**
     * A constant that represent a phone brand
     *
     * @var string
     */
    const PHONE_BRAND = 'apple';

    /**
     * A constant that represent a phone model
     *
     * @var string
     */
    const PHONE_MODEL = 'iPhone X';

    /**
     * A constant that represent a phone color
     *
     * @var string
     */
    const PHONE_COLOR = 'gold';

    /**
     * A constant that represent a phone description
     *
     * @var string
     */
    const PHONE_DESCRIPTION = 'the future is now with iPhone X';

    /**
     * A constant that represent a phone price
     *
     * @var float
     */
    const PHONE_PRICE = 789.99;

    /**
     * Test Phone entity getters and setters.
     *
     * @return void
     */
    public function testGetterSetter(): void
    {
        $phone = new Phone();

        $this->assertInstanceOf(Phone::class, $phone);
        $this->assertEquals(null, $phone->getId());
        $this->assertEquals(null, $phone->getBrand());
        $this->assertEquals(null, $phone->getModel());
        $this->assertEquals(null, $phone->getColor());
        $this->assertEquals(null, $phone->getDescription());
        $this->assertEquals(null, $phone->getPrice());

        $phone->setBrand(self::PHONE_BRAND);
        $this->assertEquals(self::PHONE_BRAND, $phone->getBrand());
        $phone->setModel(self::PHONE_MODEL);
        $this->assertEquals(self::PHONE_MODEL, $phone->getModel());
        $phone->setColor(self::PHONE_COLOR);
        $this->assertEquals(self::PHONE_COLOR, $phone->getColor());
        $phone->setDescription(self::PHONE_DESCRIPTION);
        $this->assertEquals(self::PHONE_DESCRIPTION, $phone->getDescription());
        $phone->setPrice(self::PHONE_PRICE);
        $this->assertEquals(self::PHONE_PRICE, $phone->getPrice());
    }
}
