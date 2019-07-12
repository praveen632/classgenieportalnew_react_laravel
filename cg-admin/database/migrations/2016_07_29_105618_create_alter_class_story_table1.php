<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterClassStoryTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement("ALTER TABLE `ed_class_stories` ADD `parent_ac_no` INT(10) DEFAULT 0 AFTER teacher_ac_no");
	   DB::statement("ALTER TABLE `ed_schools` ADD `phone` VARCHAR(250) NOT NULL AFTER pincode");
	   DB::statement("ALTER TABLE `ed_schools` ADD `email_id` VARCHAR(100) NOT NULL AFTER school_name");
	   DB::statement("ALTER TABLE `ed_schools` ADD `web_url` VARCHAR(250) NOT NULL AFTER school_name");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_class_story');
    }
}
