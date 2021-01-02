<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLqAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lq_answers', function (Blueprint $table) {
            $table->id();
            $table->char('answer');
            $table->foreignId('lecturer_id')->constrained();
            $table->foreignId('lq_category_id')->constrained('lq_categories');
            $table->foreignId('lq_question_id')->constrained('lq_questions');
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
        Schema::dropIfExists('lq_answers');
    }
}
