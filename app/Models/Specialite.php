<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialite extends Model
{
    use HasFactory;

    public function SpecialiteMedecin():HasMany{
        return $this->hasMany(SpecialiteMedecin::class);
    }
}
