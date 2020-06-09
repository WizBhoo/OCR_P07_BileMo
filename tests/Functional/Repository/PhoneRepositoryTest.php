<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Tests\Functional\Repository;

use App\Entity\Phone;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class PhoneRepositoryTest.
 */
class PhoneRepositoryTest extends WebTestCase
{
    /**
     * An EntityManager Instance
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Set up the EntityManager
     *
     * @return void
     */
    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * Test find a phone with existing id
     *
     * @return void
     */
    public function testFindPhone(): void
    {
        $phone = $this->entityManager
            ->getRepository(Phone::class)
            ->find(5)
        ;

        $this->assertInstanceOf(Phone::class, $phone);
        $this->assertSame('Rough Diamond', $phone->getColor());
    }

    /**
     * Called after each test using entityManager to avoid memory leaks
     *
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
