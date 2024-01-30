<?php

use App\Models\School;
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
        Schema::create('student_change_classes', function (Blueprint $table) {
            $table->id();
            $table->integer('changed_inscription_id')->default(0);
            $table->integer('new_inscription_id')->default(0);
            $table->foreignIdFor(School::class);
            $table->foreignIdFor(ScolaryYear::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_change_classes');
    }
};
