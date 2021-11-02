<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer bank_account_id
 * @property string type
 * @property string target
 * @property int amount
 * @property string description
 **/

class BankTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'target',
        'amount',
        'description',
        'timer',
    ];

    public function bankAccount(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BankAccount::class,'bank_account_id');
    }
}
