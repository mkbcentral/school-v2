<?php

use App\Models\School;
use App\Models\ScolaryYear;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_inscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('amount')->default(0);
            $table->boolean('active')->default(true);
            $table->foreignIdFor(School::class);
            $table->foreignIdFor(ScolaryYear::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cost_inscriptions');
    }
}
