<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Message
 *
 * @property string $id
 * @property string $body
 * @property string $author_id
 * @property string $messagable_id
 * @property string $messagable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $author
 * @property-read Model|\Eloquent $messagable
 * @method static \Database\Factories\MessageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessagableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessagableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Message extends Model
{
    use HasFactory, HasUuids;

    protected $hidden = ['author_id', 'messagable_id', 'messagable_type'];

    protected $fillable = [
        'body',
        'messagable_id',
        'messagable_type',
        'author_id'
    ];

    protected static function booted()
    {
        static::created(function(Message $message) {
            $message->messagable->update([]);
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function messagable(): MorphTo
    {
        return $this->morphTo();
    }
}
