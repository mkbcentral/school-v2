<?php

use App\Models\ClasseOption;
use App\Models\TypeOtherCost;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_generals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('amount')->default(0);
            $table->boolean('active')->default(true);
            $table->foreignIdFor(TypeOtherCost::class);
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
        Schema::dropIfExists('cost_generals');
    }
}
