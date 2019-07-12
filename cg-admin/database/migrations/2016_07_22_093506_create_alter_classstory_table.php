<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterClassstoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement("ALTER TABLE `ed_class_stories` DROP COLUMN `status`");
       DB::statement("ALTER TABLE `ed_class_storie_like` ADD `status` ENUM('0','1','-1') DEFAULT '0' AFTER class_id ");	   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_classstory');
    }
}
