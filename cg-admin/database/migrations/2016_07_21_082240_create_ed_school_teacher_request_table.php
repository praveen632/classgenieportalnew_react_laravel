<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdSchoolTeacherRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_school_teacher_request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id');
			$table->integer('teacher_ac_no');
			$table->enum('status', ['1', '0'])->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ed_school_teacher_request');
    }
}
