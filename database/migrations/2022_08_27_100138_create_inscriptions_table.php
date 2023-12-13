<?php

use App\Models\CostInscription;
use App\Models\Rate;
use App\Models\School;
use App\Models\ScolaryYear;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number_paiment')->nullable();
            $table->foreignIdFor(School::class);
            $table->foreignIdFor(ScolaryYear::class);
            $table->foreignIdFor(CostInscription::class);
            $table->foreignIdFor(Student::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Rate::class);
            $table->boolean('is_paied')->default(true);
            $table->boolean('is_old_student')->default(false);
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
        Schema::dropIfExists('inscriptions');
    }
}
