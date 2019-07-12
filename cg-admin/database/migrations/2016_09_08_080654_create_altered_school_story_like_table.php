<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlteredSchoolStoryLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
            DB::statement("ALTER TABLE `ed_school_story_like` DROP `status`");
            DB::statement("ALTER TABLE `ed_school_story_like` ADD `status` int(3) DEFAULT '0' AFTER school_id");
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_ed_school_story_like');
    }
}
