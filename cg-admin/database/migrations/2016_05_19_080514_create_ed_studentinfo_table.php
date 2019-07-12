<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdStudentinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_studentinfo', function (Blueprint $table) {
            $table->increments('id',11);
			$table->string('name',100);
			$table->string('student_no',100);
			$table->string('parent_no',100);
            $table->string('image',100);
			$table->string('class_id',50);
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
        Schema::drop('ed_studentinfo');
    }
}
