<?php

use App\Models\Currency;
use App\Models\Depense;
use App\Models\School;
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
        Schema::create('retour_caisses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('amount',16);
            $table->foreignIdFor(Currency::class);
            $table->foreignIdFor(Depense::class);
            $table->foreignIdFor(School::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retour_caisses');
    }
};
