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
		DB::statement("ALTER TABLE `ed_attendance` DROP `attendance`");
        DB::statement("ALTER TABLE `ed_attendance` ADD `attendance` ENUM('A','P','L','H','TA') DEFAULT 'P' AFTER  	student_no ");   
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_ed_attendance');
    }
}
