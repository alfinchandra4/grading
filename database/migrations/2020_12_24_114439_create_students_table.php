<?php

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
            $table->id();
            $table->string('name');
            $table->char('nim');
            $table->string('password');
            $table->string('faculty'); // ilmu komputer
            $table->char('major');
            $table->char('generation');
            $table->char('gender'); // 1; pria , 2;wanita
            $table->string('birth');
            $table->date('dob'); // date of birth
            $table->char('phone');
            $table->char('email');
            $table->char('active')->default(1); // pasif for alumni
            $table->dateTime('filled')->nullable();
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
