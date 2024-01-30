<?php

use App\Models\ScolaryYear;
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
        Schema::table('depense_sources', function (Blueprint $table) {
            $table->foreignIdFor(ScolaryYear::class)->nullable()->after('month_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('depense_sources', function (Blueprint $table) {
            $table->dropColumn('scolary_year_id	');
        });
    }
};
