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

    protected $casts = [
        'sheet' => 'array'
    ];

    public function availableTo(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(DiscordRoles::class,'discord_roles_dinosaurs_pivot_table','dinosaur_id','discord_role_id');
    }
}
