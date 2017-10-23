<?php

namespace Tests\Feature;

use App\Challenge;
use App\Channel;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilesTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function a_user_has_a_profile()
    {
        $user = create(User::class);
        $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);
    }

    /** @test */
    public function profiles_display_all_channels_that_has_been_created_by_a_user()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $user = auth()->user();

        $channel = create(Channel::class, ['creator_id' => $user->id]);

        $this->get("/profiles/{$user->name}")
            ->assertSee($channel->name)
            ->assertSee($channel->description);
    }
}
