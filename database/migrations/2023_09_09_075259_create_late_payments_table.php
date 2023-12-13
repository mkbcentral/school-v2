<?php

use App\Models\CostGeneral;
use App\Models\Inscription;
use App\Models\Rate;
use App\Models\School;
use App\Models\ScolaryYear;
use App\Models\User;
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
        Schema::create('late_payments', function (Blueprint $table) {
            $table->id();
            $table->string('number_payment')->nullable();
            $table->string('month_name')->nullable();
            $table->string('currency');
            $table->float('amount')->default(0);
            $table->foreignIdFor(Inscription::class);
            $table->foreignIdFor(CostGeneral::class);
            $table->foreignIdFor(Rate::class);
            $table->foreignIdFor(ScolaryYear::class);
            $table->foreignIdFor(School::class);
            $table->foreignIdFor(User::class);
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_printed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('late_payments');
    }
};
