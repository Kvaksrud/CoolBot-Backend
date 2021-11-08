<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DiscordRole
 * @package App\Models
 *
 * @property string friendly_name
 * @property int discord_id
 * @property number modifier
 */

class DiscordRole extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    public function availableDinosaurs(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Dinosaur::class,'discord_roles_dinosaurs_pivot_table','discord_role_id','dinosaur_id');
    }

    public function availableTeleports(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Teleport::class,'discord_roles_teleports_pivot_table','discord_role_id','teleport_id');
    }

    public function canInject($dinosaur_code): bool
    {
        if(in_array($dinosaur_code,$this->availableDinosaurs()->pluck('code')->toArray()))
            return true;
        return false;
    }

    public function canTeleport($location_code): bool
    {
        if(in_array($location_code,$this->availableTeleports()->pluck('code')->toArray()))
            return true;
        return false;
    }
}
