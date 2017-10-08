<?php

namespace Tests\Feature;

use App\Challenge;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChallengesCreationTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_users_can_not_create_challenges()
    {

    }

    /** @test */
    public function new_users_must_first_confirm_their_email_address_before_creating_challenges()
    {
        $user = factory(User::class)->states('unconfirmed')->create();
        $this->signIn($user);

        $thread = make(Challenge::class);

        $this->post(route('challenges'), $thread->toArray())
            ->assertRedirect(route('challenges'))
            ->assertSessionHas('flash', 'You must first confirm your email'); // Maybe delete this message...
    }

    /** @test */
    public function authenticated_users_can_create_challenges()
    {

    }
    
    /** @test */
    public function creator_can_set_the_challenge_live_time_that_determine_when_it_gets_closed()
    {
        // only creator -> authorization!
    }
    
    /** @test */
    public function creator_can_not_modify_a_challenge_once_it_has_been_published()
    {
        
    }
    
    /** @test */
    public function creator_can_add_requirements_to_his_created_challenges()
    {
        
    }

    /** @test */
    public function creator_can_add_rewards_to_their_challenges()
    {

    }
    
    /** @test */
    public function creator_can_challenge_users()
    {
        
    }
}
