<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterTwoTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
	
	   DB::statement("ALTER TABLE `ed_users` DROP `type`");	
	   DB::statement("ALTER TABLE `ed_users` ADD `type` ENUM('0','1','2','3','4','5') DEFAULT '0' AFTER member_no ");
	   
	   DB::statement("ALTER TABLE `ed_class_stories` ADD `username` VARCHAR(100) NOT NULL AFTER student_no ");
	   
	   DB::statement("ALTER TABLE `ed_student_stories` ADD `username` VARCHAR(100) NOT NULL AFTER student_no ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_two_table');
    }
}
