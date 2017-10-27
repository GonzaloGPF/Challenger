<?php

namespace Tests\Unit;

use App\Category;
use App\Channel;
use App\Message;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelsTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @var Channel
     */
    protected $channel;

    protected function setUp()
    {
        parent::setUp();
        $this->channel = create(Channel::class);
    }

    /** @test */
    public function it_knows_all_messages_sent()
    {
        $this->assertInstanceOf(Collection::class, $this->channel->messages);
    }

    /** @test */
    public function it_has_a_path()
    {
        $this->assertEquals("channels/{$this->channel->name}", $this->channel->path());
    }

    /** @test */
    public function it_has_a_creator()
    {
        $this->assertInstanceOf(User::class, $this->channel->creator);
    }

    /** @test */
    public function it_has_a_pusher_name()
    {
        $channel = create(Channel::class);

        $this->assertEquals("channel.$channel->id", $channel->pusherName);
    }

    /** @test */
    public function it_can_get_channel_from_pusher_channel_name()
    {
        $id = $this->channel->id;

        $this->assertInstanceOf(Channel::class, Channel::getChannelFromPusherChannelName('presence-channel.' . $id));
    }

    /** @test */
    public function it_has_users_in()
    {
        $this->assertInstanceOf(Collection::class, $this->channel->users);
    }

    /** @test */
    public function it_knows_how_many_users_are_in_channel()
    {
        create(User::class, [], 3)->each->joinToChannel($this->channel);

        $this->assertEquals(3, $this->channel->fresh()->users_count);
    }

    /** @test */
    public function it_belongs_to_a_category()
    {
        $this->assertInstanceOf(Category::class, $this->channel->category);
    }
}
