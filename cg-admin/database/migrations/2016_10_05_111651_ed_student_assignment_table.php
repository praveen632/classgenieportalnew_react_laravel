<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EdStudentAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_student_assignment', function (Blueprint $table) {
            $table->increments('id');
			$table->string('assignment_id',10);
			$table->string('teacher_ac_no',50);
			$table->string('class_id',50);
			$table->string('student_no',50);
			$table->string('grade',50);
			$table->enum('status', ['0', '1','2'])->default('0');
			$table->string('submition_date',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ed_student_assignment');
    }
}
