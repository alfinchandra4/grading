<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAqAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aq_answers', function (Blueprint $table) {
            $table->id();
            $table->char('answer');
            $table->foreignId('alumni_id')->constrained('alumnus');
            $table->foreignId('aq_category_id')->constrained('aq_categories');
            $table->foreignId('aq_question_id')->constrained('aq_questions');
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
        Schema::dropIfExists('aq_answers');
    }
}
