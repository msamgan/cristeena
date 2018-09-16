<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\SlugBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\SlugBehavior Test Case
 */
class SlugBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\SlugBehavior
     */
    public $Slug;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Slug = new SlugBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Slug);

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
