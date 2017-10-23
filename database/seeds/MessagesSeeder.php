<?php

use Illuminate\Database\Seeder;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Channel::all()->each(function($channel) {
            factory(\App\Message::class, rand(1, 10))->create([
                'channel_id' => $channel->id
            ]);
        });
    }
}
