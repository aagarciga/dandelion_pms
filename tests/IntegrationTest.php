<?php


namespace App\Tests;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class IntegrationTest
 * @package App\Tests
 *
 * @author Alex Alvarez Gárciga
 */
class IntegrationTest extends KernelTestCase
{
    /**
     * Alex:
     *
     * Integration Test:
     *  To test one specific function on a class
     *  Uses real database connections
     *
     * Using TDD principles:
     *  1. Create the test
     *  2. Write just enough code for the test to pass
     *  3. Refactor your code
     *
     * As a rule, you will want to mock service classes, but you do not need to mock model classes.
     *
     */
    public function test_PHPUnitWorks()
    {
        // Alex: To boot the Symfony Kernel and get the real services
//         self::bootKernel();
        // then:
        //
//        /** @var EntityManager $entityManager */
//        $entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();


        $this->assertTrue(true, 'Did you run: composer install?');
        $this->markTestIncomplete('TODO: Be sure to not forget mark test incomplete in order to move on');
        // $this->markTestSkipped('TODO: Be sure to not forget skip some test in order to move on');
        // $this->markAsRisky();

    }

    /**
     * Alex: PHPUnit will automatically call it before the test.
     */
    protected function setUp()
    {
        parent::setUp();
    }

    protected function activateReferenceCheck(EntityManager $entityManager , $active = true)
    {
        $connection = $entityManager->getConnection();
        $platform = $connection->getDatabasePlatform();

    }




}