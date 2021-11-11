<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dinosaur
 * @package App\Models
 *
 * @property string display_name
 * @property string code
 * @property int cost
 * @property string sheet
 */

class Dinosaur extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    protected $casts = [
        'sheet' => 'array'
    ];

    public function availableTo(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(DiscordRole::class,'discord_roles_dinosaurs_pivot_table','dinosaur_id','discord_role_id');
    }

    public function requests(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(DinosaurRequest::class,'requestable');
    }
}
