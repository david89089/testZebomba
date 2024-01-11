<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UserSession
 *
 * @property int $user_id
 * @property string $access_token
 */

class UserSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'access_token'
    ];

    protected $guarded = [
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
