<?php

namespace Tests\Feature;

use App\Channel;
use App\Message;
use App\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelsChatTest extends TestCase
{
    use DatabaseMigrations;

    public $user;

    protected function setUp()
    {
        parent::setUp();
        $this->user = create(User::class);
    }

    /** @test */
    public function users_can_see_all_public_channels()
    {
        $channel = create(Channel::class);

        $this->get('/channels')
            ->assertSee($channel->name)
            ->assertSee($channel->description);
    }

    /** @test */
    public function users_can_not_see_private_channels()
    {
        $channel = factory(Channel::class)->states('private')->create();

        $this->get('/channels')
            ->assertDontSee($channel->name);
    }

    /** @test */
    public function authenticated_users_in_a_channel_can_fetch_messages_from_other_users()
    {
        $this->signIn();

        $channel = create(Channel::class);

        $channel->users()->save(auth()->user());

        $message = create(Message::class, ['channel_id' => $channel->id]);
//        $channel->messages()->saveMany(create(Message::class, [], 3));

        $this->getJson($channel->path('messages'))
            ->assertSee($message->text);
    }

    /** @test */
    public function users_can_see_other_users()
    {
        create(User::class);

        $response = $this->getJson('/users');

        $this->assertCount(2, $response->getData()->data);
    }

    /** @test */
    public function unauthenticated_users_can_not_send_messages_to_channels()
    {
        $channel = create(Channel::class);
        $message = make(Message::class, ['user_id' => $this->user->id]);

        $this->postJson($channel->path('messages'), $message->toArray())
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function authenticated_users_can_not_send_messages_to_channels_if_has_not_join()
    {
        $this->signIn($this->user);

        $channel = create(Channel::class);
        $message = make(Message::class, ['user_id' => $this->user->id]);

        $this->postJson($channel->path('messages'), $message->toArray())
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function authenticated_user_can_send_messages()
    {
        $this->signIn($this->user);

        $channel = create(Channel::class);

        $this->user->joinToChannel($channel);

        $message = make(Message::class, [
            'user_id' => $this->user->id
        ]);

        $this->postJson($channel->path('messages'), $message->toArray())
            ->assertStatus(Response::HTTP_OK);

        $this->assertCount(1, $channel->fresh()->messages);
    }

    /** @test */
    public function messages_always_shows_creator()
    {
        $this->signIn($this->user);

        $channel = create(Channel::class);

        $this->user->joinToChannel($channel);

        $message = create(Message::class, [
            'user_id' => $this->user->id,
            'channel_id' => $channel->id
        ]);

        $this->getJson($channel->path('messages'))
            ->assertSee($message->user->name)
            ->assertSee($message->text);
    }

    //    /** @test */
//    public function authenticated_user_can_invite_others_users_to_channels()
//    {
//
//    }
//
//    /** @test */
//    public function authenticated_user_can_block_messages_from_other_user()
//    {
//
//    }
}
