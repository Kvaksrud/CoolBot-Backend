<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer discord_registration_id
 * @property string status
 * @property int status_updated_by_user_id
 * @property string status_comment
 * @property Carbon last_status_changed
 * @property string text_before
 * @property string text_after
 * @property string target
 **/

class LaborReply extends Model
{
    use HasFactory;

    protected $casts = [
        'last_status_change' => 'datetime'
    ];

    protected $with = [
        'suggested_by',
        'status_updated_by'
    ];

    public function suggested_by(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DiscordRegistration::class,'discord_registration_id', 'id');
    }

    public function status_updated_by(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'status_updated_by_user_id', 'id');
    }
}
