<?php

use App\Models\Medecin;
use App\Models\Patient;
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
        Schema::create('patient_rendez_vouses', function (Blueprint $table) {
            $table->id();
            $table->string('motif');
            $table->string('status');
            $table->string('heure');
            $table->string('date')->nullable();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Medecin::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_rendez_vouses');
    }
};