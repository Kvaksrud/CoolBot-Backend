<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dinosaur
 * @package App\Models
 *
 * @property string discord_registration_id
 * @property int cost
 * @property string sheet
  */

class DinosaurRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'discord_registration_id',
        'cost',
        'sheet'
    ];

    protected $casts = [
        'sheet' => 'array'
    ];

    public function by(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DiscordRegistration::class,'discord_registration_id','id');
    }

    public function requestable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
