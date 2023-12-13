<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\School;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('scolary_years', function (Blueprint $table) {
            $table->foreignIdFor(School::class)->nullable()->after('is_old_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scolary_years', function (Blueprint $table) {
            $table->dropColumn('school_id');
        });
    }
};
