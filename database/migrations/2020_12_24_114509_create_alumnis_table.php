<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('nim');
            $table->string('faculty'); // ilmu komputer
            $table->char('major');
            $table->integer('generation');
            $table->char('gender'); // 1; pria , 2;wanita
            $table->string('birth');
            $table->date('dob'); // date of birth
            $table->char('phone');
            $table->char('email');
            $table->char('active')->default(1); // pasif for alumni
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
        Schema::dropIfExists('alumnus');
    }
}
