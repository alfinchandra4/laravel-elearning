<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Studentchoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_choices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->foreignId('choice_id')->constrained()->cascadeOnDelete();

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
        Schema::dropIfExists('student_answers');
    }
}
