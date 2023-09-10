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
            foreach($users as $_user) {
                if ($user->id === $_user->id || $created->filter(fn($value) => !count(array_diff($value, [$user->id, $_user->id])))->count()) {
                    continue;
                }

                $created->push([
                    $user->id,
                    $_user->id
                ]);

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
