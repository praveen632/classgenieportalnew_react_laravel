<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdTeacherStudentRemarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_teacher_student_remark', function (Blueprint $table) {
            $table->increments('id');
			$table->string('student_no',50);
			$table->string('class_id',100);
			$table->integer('teacher_ac_no');
			$table->text('remark')->nullable();
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
        Schema::drop('ed_teacher_student_remark');
    }
}
