<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterTableAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    
	   DB::statement("ALTER TABLE `cms_contactus` DROP `status`");	
	   DB::statement("ALTER TABLE `cms_contactus` ADD `status` ENUM('1','-1') DEFAULT 1 AFTER message ");
     

       DB::statement("ALTER TABLE `cms_content` DROP `status`");	
       DB::statement("ALTER TABLE `cms_content` ADD `status` ENUM('1','-1') DEFAULT 1 AFTER url ");

       DB::statement("ALTER TABLE `cms_email` DROP `status`");	
       DB::statement("ALTER TABLE `cms_email` ADD `status` ENUM('1','-1') DEFAULT 1 AFTER feature ");

       DB::statement("ALTER TABLE `cms_news_letter` DROP `status`");	
       DB::statement("ALTER TABLE `cms_news_letter` ADD `status` ENUM('1','-1') DEFAULT 1 AFTER email ");

       DB::statement("ALTER TABLE `ed_users` DROP `status`");	
       DB::statement("ALTER TABLE `ed_users` ADD `status` ENUM('1','-1') DEFAULT 1 AFTER type ");
       DB::statement("ALTER TABLE `ed_users` DROP `class_id`");	  
	   
	   DB::statement("ALTER TABLE `ed_classinfo` ADD `school_id` INT(10) DEFAULT 0 AFTER class_id "); 
	   DB::statement("ALTER TABLE `ed_classinfo` CHANGE member_no teacher_ac_no int(11) NOT NULL");
	  
	   DB::statement("ALTER TABLE `ed_studentinfo` CHANGE member_no parent_ac_no int(11) NOT NULL");  
	   DB::statement("ALTER TABLE `ed_studentinfo` DROP `status`");
	   
	   DB::statement("ALTER TABLE `ed_customize_skills` DROP `member_no`");
	   
	   DB::statement("ALTER TABLE `ed_class_stories` DROP `member_no`");
	   
	   DB::statement("ALTER TABLE `ed_class_comments` DROP `member_no`");
	   
	   DB::statement("ALTER TABLE `ed_groupinfo` DROP `member_no`");
	   DB::statement("ALTER TABLE `ed_groupinfo` DROP `student_name`");
	   DB::statement("ALTER TABLE `ed_groupinfo` DROP `image`");
	   
	   DB::statement("ALTER TABLE `ed_groupinfo` CHANGE student_no student_no VARCHAR(255) NOT NULL");
	   	     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_table_all');
    }
}
