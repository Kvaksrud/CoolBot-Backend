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

    public function bankAccount(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BankAccount::class,'discord_registration_id','id');
    }

    public function canAfford($amount,$target='wallet'): bool
    {
        if(!$this->bankAccount) return false;

        if($target === 'wallet'){
            if($this->bankAccount->wallet >= $amount) return true;
        } elseif($target === 'balance'){
            if($this->bankAccount->balance >= $amount) return true;
        }
        return false;
    }
}
