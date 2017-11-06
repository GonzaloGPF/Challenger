<?php

namespace Tests\Feature;

use App\Channel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelsReadTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @var Channel
     */
    public $channel;

    protected function setUp()
    {
        parent::setUp();
        $this->channel = create(Channel::class);
    }

    /** @test */
    public function users_can_see_all_public_channels()
    {
        $this->get('/channels')
            ->assertSee($this->channel->name);
    }

    /** @test */
    public function authenticated_user_can_see_single_channel()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get($this->channel->path())
            ->assertSee($this->channel->name);
    }
}
