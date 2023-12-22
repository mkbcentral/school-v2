<?php

use App\Models\Currency;
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
        Schema::create('agent_salaries', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('month_name');
            $table->float('amount')->default(0);
            $table->foreignIdFor(School::class);
            $table->foreignIdFor(Currency::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_salaries');
    }
};
