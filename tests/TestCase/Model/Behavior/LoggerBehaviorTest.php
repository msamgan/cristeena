<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\LoggerBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\LoggerBehavior Test Case
 */
class LoggerBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\LoggerBehavior
     */
    public $Logger;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Logger = new LoggerBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Logger);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
