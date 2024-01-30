<?php

use App\Models\BankDeposit;
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
        Schema::create('bank_deposit_missings', function (Blueprint $table) {
            $table->id();
            $table->float('amount')->default(0);
            $table->string('description')->nullable();
            $table->foreignIdFor(BankDeposit::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_deposit_missings');
    }
};
