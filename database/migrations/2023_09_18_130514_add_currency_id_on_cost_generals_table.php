<?php
;
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
        Schema::table('cost_generals', function (Blueprint $table) {
            $table->foreignIdFor(Currency::class)->nullable()->after('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cost_generals', function (Blueprint $table) {
            $table->dropColumn('currecy_id');
        });
    }
};
