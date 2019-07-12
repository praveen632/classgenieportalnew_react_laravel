<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_attendance', function (Blueprint $table) {
            $table->increments('id');
			$table->string('class_id',50);
			$table->string('student_no',50);
			$table->enum('attendance', ['A', 'P', 'L'])->default('P');
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
        Schema::drop('ed_attendance');
    }
}
