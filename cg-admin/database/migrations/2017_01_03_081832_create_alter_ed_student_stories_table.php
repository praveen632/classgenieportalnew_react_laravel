<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterEdStudentStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement("ALTER TABLE `ed_student_stories` DROP `status`");  
       DB::statement("ALTER TABLE `ed_student_stories` ADD `status` ENUM('0','1','-1') DEFAULT '0' AFTER username ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_ed_student_stories');
    }
}
