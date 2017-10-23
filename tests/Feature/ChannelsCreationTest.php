<?php

namespace Tests\Feature;

use App\Challenge;
use App\Channel;
use App\Language;
use App\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelsCreationTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_users_can_not_create_channels()
    {
        $this->get('channels/create')
            ->assertRedirect(route('login'));

        $this->post('channels')
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function new_users_must_first_confirm_their_email_address_before_creating_channels()
    {
        $user = factory(User::class)->states('unconfirmed')->create();
        $this->signIn($user);

        $channel = make(Channel::class);

        $this->post('/channels', $channel->toArray())
            ->assertRedirect('channels') // assertRedirect?
            ->assertSessionHas('flash', 'You must first confirm your email'); // Maybe delete this message...
    }

    /** @test */
    public function authenticated_users_can_create_channels()
    {
        $this->signIn();

        $channel = make(Channel::class);

        $this->post('channels', $channel->toArray())
            ->assertRedirect('/chat');

        $this->assertCount(1, auth()->user()->channels);
    }

    //TODO: uncomment and fill this test!
//    /** @test */
//    public function authenticated_users_can_create_private_channels()
//    {
//
//    }

    /** @test */
    public function creators_can_edit_their_created_channels()
    {
        $user = create(User::class);
        $this->signIn($user);

        $channel = create(Channel::class, ['creator_id' => $user->id]);
        $language = create(Language::class);

        $this->patch($channel->path(), ['language_id' => $language->id])
            ->assertRedirect('chat');

        $this->assertEquals($language->name, $channel->fresh()->language->name);
    }

//    /** @test */
//    public function creators_can_set_channel_capacity()
//    {
//
//    }
//
//    /** @test */
//    public function creators_can_set_users_roles()
//    {
//
//    }
//
//    /** @test */
//    public function creators_can_kick_users()
//    {
//
//    }
//
//    /** @test */
//    public function it_must_have_a_minimum_of_two_user_capacity()
//    {
//
//    }
}
