<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    use HasFactory;
    
       protected $fillable = [
        'user_id',
        'amount',
        'duration',
        'period_duration',
        'period_repay',
        'interest_rate',
        'modality_id',
    ];


       public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

      public function modality(): BelongsTo
    {
        return $this->belongsTo(Modality::class);
    }

    public function versements(): HasMany
    {
        return $this->hasMany(Versement::class);
    }

    public function montants(): HasMany
    {
        return $this->hasMany(Montant::class);
    }
   


}
