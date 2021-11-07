<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DiscordRoles
 * @package App\Models
 *
 * @property string friendly_name
 * @property int discord_id
 * @property number modifier
 */

class DiscordRoles extends Model
{
    use HasFactory;

    public function availableDinosaurs(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Dinosaur::class,'discord_roles_dinosaurs_pivot_table','discord_role_id','dinosaur_id');
    }
}
