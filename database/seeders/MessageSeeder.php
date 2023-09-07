<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $chats = Chat::all();

        foreach($chats as $chat) {
            for($i = 0; $i < 25; $i++) {
                $random = random_int(0, 1);
                $users = $chat->users()->get();

                Message::factory()->create([
                    'author_id' => $users[$random]->id,
                    'messagable_id' => $chat->id,
                    'messagable_type' => Chat::class
                ]);
            }
        }
    }
}
