<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\MethodsComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\MethodsComponent Test Case
 */
class MethodsComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\MethodsComponent
     */
    public $Methods;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Methods = new MethodsComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Methods);

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
