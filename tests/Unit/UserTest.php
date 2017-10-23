<?php

namespace Tests\Unit;

use App\Channel;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function users_can_join_and_leave_channels()
    {
        $channel = create(Channel::class);
        $user = create(User::class);

        $this->assertCount(0, $channel->users);

        $user->joinToChannel($channel);

        $this->assertCount(1, $channel->fresh()->users);

        $user->leaveChannel($channel);

        $this->assertCount(0, $channel->fresh()->users);
    }

    /** @test */
    public function it_knows_all_created_channels()
    {
        $user = create(User::class);

        $this->assertInstanceOf(Collection::class, $user->createdChannels);
    }

    /** @test */
    public function it_knows_all_created_messages()
    {
        $user = create(User::class);

        $this->assertInstanceOf(Collection::class, $user->messages);
    }
}
