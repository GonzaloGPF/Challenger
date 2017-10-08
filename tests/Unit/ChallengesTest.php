<?php

namespace Tests\Unit;

use App\Challenge;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChallengesTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @var Challenge
     */
    protected $challenge;

    protected function setUp()
    {
        parent::setUp();
        $this->challenge = create(Challenge::class);
    }

    /** @test */
    public function it_has_a_title_and_a_description()
    {

    }

    /** @test */
    public function it_has_a_path()
    {
        $this->assertEquals("/challenges/{$this->challenge->slug}/{$this->challenge->slug}", $this->challenge->path());
    }

    /** @test */
    public function it_has_a_creator()
    {
        $this->assertInstanceOf(User::class, $this->challenge->creator);
    }

    /** @test */
    public function it_has_participators()
    {
        $this->assertInstanceOf(Collection::class, $this->challenge->participators);
    }

    /** @test */
    public function it_kwons_how_many_participators_have_achieved_the_challenge()
    {

    }

    /** @test */
    public function it_must_have_a_minimum_of_one_requirement_to_be_published()
    {

    }

    /** @test */
    public function it_knows_what_users_has_achieved_the_challenge()
    {
        // Given a challenge with specific goal points
        // Get all users that achieve that goal by sum every requirement point
    }
}
