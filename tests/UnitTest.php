<?php


namespace App\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class UnitTest
 * @package App\Tests
 *
 * @author Alex Alvarez Gárciga
 */
class UnitTest extends TestCase
{
    /**
     * Alex:
     *
     * Unit test:
     *  To test one specific function on a class
     *  Fake any needed database connections
     * Functional Test:
     *  Programmatically command a browser and test response
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

    /**
     * Alex: PHPUnit will automatically call it after the test
     */
    protected function tearDown()
    {
        parent::tearDown();
    }


}