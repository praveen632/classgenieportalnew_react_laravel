<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdStudentinfoPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_studentinfo_point', function (Blueprint $table) {
           $table->string('class_id',50);
		   $table->string('student_info_no',50);
		   $table->integer('point');
		   $table->integer('customize_skills_id');
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
        Schema::drop('ed_studentinfo_point');
    }
}
