<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Montant extends Model
{
    
    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

}
