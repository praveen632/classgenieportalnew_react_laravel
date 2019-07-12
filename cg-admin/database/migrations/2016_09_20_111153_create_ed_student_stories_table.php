<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdStudentStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_student_stories', function (Blueprint $table) {
            $table->increments('id');
			$table->string('image',100);
			$table->text('message')->nullable();
            $table->string('class_id',100);
			$table->integer('teacher_ac_no');
			$table->string('student_no',50);
			$table->enum('status', ['0', '1'])->default('0');
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
        Schema::drop('ed_student_stories');
    }
}
