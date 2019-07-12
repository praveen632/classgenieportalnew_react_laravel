<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassStoryTeachernameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        DB::statement("ALTER TABLE `ed_class_stories` ADD `teacher_name` VARCHAR(100) NOT NULL AFTER username ");
	   
	   DB::statement("ALTER TABLE `ed_school_story` ADD `teacher_name` VARCHAR(100) NOT NULL AFTER teacher_ac_no ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('class_story_teachername');
    }
}
