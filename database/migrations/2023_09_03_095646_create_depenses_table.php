<?php

use App\Models\Currency;
use App\Models\DepenseSource;
use App\Models\School;
use Doctrine\DBAL\Schema\Table;
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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('amount')->default(0);
            $table->foreignIdFor(DepenseSource::class);
            $table->foreignIdFor(Currency::class);
            $table->foreignIdFor(School::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
