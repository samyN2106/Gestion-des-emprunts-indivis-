<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Versement extends Model
{

public function loan():BelongsTo
{
    return $this->belongsTo(Loan::class);
}
    

   protected $fillable = [
        'loan_id',
        'periode',
        'amount',
        'date_versement',
        'statut',
    ];

}
