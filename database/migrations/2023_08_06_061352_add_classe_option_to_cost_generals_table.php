<?php

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
        Schema::table('cost_generals', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\ClasseOption::class)->after('amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cost_generals', function (Blueprint $table) {
            $table->dropColumn('classe_option_id');
        });
    }
};
