<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer discord_registration_id
 * @property string type
 * @property array content
 **/

class CharacterSheet extends Model
{
    use HasFactory;

    protected $casts = [
        'content' => 'array',
    ];

    protected $with = [
        'member'
    ];

    public function member()
    {
        return $this->belongsTo(DiscordRegistration::class,'discord_registration_id','id');
    }
}
