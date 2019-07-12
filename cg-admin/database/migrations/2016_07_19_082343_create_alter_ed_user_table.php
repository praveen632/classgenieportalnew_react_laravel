<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterEdUserTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	   DB::statement("ALTER TABLE `ed_users` DROP `status`");	
       DB::statement("ALTER TABLE `ed_users` ADD `status` ENUM('1','0') DEFAULT '0' AFTER type ");
	   
	    
		DB::statement("ALTER TABLE `ed_parent_user` CHANGE parent_ac_no parent_ac_no VARCHAR(50) NOT NULL");
		DB::statement("ALTER TABLE `ed_parent_user` CHANGE student_ac_no student_ac_no VARCHAR(50) NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_ed_users');
    }
}
