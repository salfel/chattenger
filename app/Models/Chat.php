<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Models\Chat
 *
 * @property string $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Message> $messages
 * @property-read int|null $messages_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\ChatFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Chat extends Model
{
    use HasFactory, HasUuids;

    public function messages(): MorphMany
    {
        return $this->morphMany(Message::class, 'messagable');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'chat_users');
    }

    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, ChatUser::class, 'chat_id', 'id', 'id', 'user_id');
    }

    public function getUser(string $id)
    {
        return $this->users()->whereNot('users.id', $id)->first();
    }
}
