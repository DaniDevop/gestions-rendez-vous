<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpecialiteMedecin extends Model
{
    use HasFactory;


    public function medecin():BelongsTo{
        return $this->belongsTo(Medecin::class);
    }


    public function specialite():BelongsTo{

        return $this->belongsTo(Specialite::class);
    }
}
