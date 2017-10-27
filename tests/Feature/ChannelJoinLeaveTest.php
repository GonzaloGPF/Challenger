<?php

namespace Tests\Feature;

use App\Channel;
use App\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelJoinLeaveTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_users_can_not_join_channels()
    {
        $this->postJson('broadcasting/auth')
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function authenticated_users_can_join_and_leave_public_channels()
    {
        $this->signIn();
        $channel = create(Channel::class);

        $this->assertCount(0, $channel->users);

        $this->postJson('channels/join', [
            'name' => 'member_added',
            'channel' => "presence-$channel->pusherName",
            'user_id' => auth()->id()
        ])
            ->assertStatus(Response::HTTP_OK);

        $this->assertCount(1, $channel->fresh()->users);
//
//        $this->postJson('channels/leave', [
//            'name' => 'member_removed',
//            'channel' => "presence-$channel->pusherName",
//            'user_id' => auth()->id()
//        ])
//            ->assertStatus(Response::HTTP_OK);
//
//        $this->assertCount(0, $channel->users);
    }

    /** @test */
    public function authenticated_user_can_not_join_in_a_public_channel_that_is_full()
    {
        $this->withExceptionHandling();
        $channel = create(Channel::class, ['capacity' => 2]);

        $channel->users()->saveMany(create(User::class, [], 2));

        $this->assertCount(2, $channel->fresh()->users);
        $this->signIn();
        $this->postJson("channels/join/$channel->name")
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
