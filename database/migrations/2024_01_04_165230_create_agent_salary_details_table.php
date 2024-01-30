<?php

use App\Models\AgentSalary;
use App\Models\Currency;
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
        Schema::create('agent_salary_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('amount')->default(0);
            $table->foreignIdFor(Currency::class);
            $table->foreignIdFor(AgentSalary::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_salary_details');
    }
};
