<?php

use App\Models\School;
use App\Models\ScolaryYear;
use App\Models\StudentResponsable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->enum('gender', ['M', 'F']);
            $table->string('place_of_birth')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->foreignIdFor(StudentResponsable::class);
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
        Schema::dropIfExists('students');
    }
}
