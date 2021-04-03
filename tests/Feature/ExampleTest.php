<?php

namespace Tests\Feature;
use App\Channel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    private $channel;
    protected function setUp() : void
    {
        parent::setUp();
       $this->channel = factory(Channel::class)->create();

    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function we_can_see_channel_name()
    {
        $this->get('/')
            ->assertSee($this->channel->name);
    }

    /** @test */
    public function user_can_visit_home_page()
    {
        $this->be(factory('App\User')->create())
            ->get('/home')
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_visit_a_channel()
    {
        $this->get('/forum/channel/'.$this->channel->id)
            ->assertSee($this->channel->name);
    }
    /** @test */
    public function a_user_can_reply_on_a_problem()
    {
        
    }
}
