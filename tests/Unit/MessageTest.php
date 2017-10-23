<?php

namespace Tests\Unit;

use App\Channel;
use App\Message;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MessageTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @var Message
     */
    protected $message;

    protected function setUp()
    {
        parent::setUp();
        $this->message = create(Message::class);
    }

    /** @test */
    public function a_message_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->message->user);
    }

    /** @test */
    public function a_message_belongs_to_a_channel()
    {
        $this->assertInstanceOf(Channel::class, $this->message->channel);
    }
}
