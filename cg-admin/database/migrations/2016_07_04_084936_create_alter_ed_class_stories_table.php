<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterEdClassStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::statement("ALTER TABLE `ed_class_stories` ADD `teacher_ac_no` INT(10) DEFAULT 0 AFTER class_id");
		 DB::statement("ALTER TABLE `ed_class_comments` ADD `member_no` INT(10) DEFAULT 0 AFTER class_id");
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_ed_class_stories');
    }
}
