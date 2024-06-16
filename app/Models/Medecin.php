<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medecin extends Model
{
    use HasFactory;


    public function emploie_temps():HasMany{
        return $this->hasMany(EmploieTemps::class);
    }


    public function patientRendezVous():HasMany{

        return $this->hasMany(patientRendezVous::class);
    }
}