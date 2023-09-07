<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\ChatUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $created = new Collection();
        foreach($users as $user) {
            $created[] = $user->id;
            foreach($users as $_user) {
                if ($created->has($_user->id) || $user->id === $_user->id) {
                    continue;
                }

                $chat = Chat::factory()->create();

                ChatUser::create([
                    'chat_id' => $chat->id,
                    'user_id' => $user->id
                ]);

                ChatUser::create([
                    'chat_id' => $chat->id,
                    'user_id' => $_user->id
                ]);
            }
        }
    }
}
