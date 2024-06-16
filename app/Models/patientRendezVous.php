<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class patientRendezVous extends Authenticatable
{
    use HasFactory;


    public function medecin():BelongsTo{

        return $this->belongsTo(Medecin::class);
    }


    public function patient():BelongsTo{

        return $this->belongsTo(Patient::class);
    }
}