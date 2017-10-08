<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipationTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_users_can_not_participate_in_challenges()
    {

    }

    /** @test */
    public function authenticated_users_can_participate_in_challenges()
    {

    }

    /** @test */
    public function an_authenticated_user_can_not_participate_in_a_closed_challenge()
    {

    }

    /** @test */
    public function an_authenticated_user_can_vote_each_requirement_of_other_user_participation()
    {

    }

    /** @test */
    public function an_authenticated_user_can_not_vote_self_participation()
    {

    }
}
