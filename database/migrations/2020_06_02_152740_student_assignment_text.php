<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentAssignmentText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_assignment_text', function (Blueprint $table) {
            $table->id();

            $table->foreignId('assignment_id')->constrained();
            $table->foreignId('student_assignment_id')->constrained('student_assignments');
            $table->foreignId('student_id')->constrained();

            $table->text('text');

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
        Schema::dropIfExists('student_assignment_text');
    }
}
