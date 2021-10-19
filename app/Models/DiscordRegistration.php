<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer guild_id
 * @property integer member_id
 * @property integer steam_id
 * @property string username
 **/

class DiscordRegistration extends Model
{
    use HasFactory;


}
