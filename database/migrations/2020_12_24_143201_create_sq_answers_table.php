<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSqAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sq_answers', function (Blueprint $table) {
            $table->id();
            $table->char('answer');
            $table->foreignId('student_id')->constrained();
            $table->foreignId('sq_category_id')->constrained('sq_categories');
            $table->foreignId('sq_question_id')->constrained('sq_questions');
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
        Schema::dropIfExists('sq_answers');
    }
}
