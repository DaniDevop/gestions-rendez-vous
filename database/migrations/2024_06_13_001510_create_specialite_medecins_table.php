<?php

use App\Models\Medecin;
use App\Models\Specialite;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('specialite_medecins', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Medecin::class)->nullable();
            $table->foreignIdFor(Specialite::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialite_medecins');
    }
};
