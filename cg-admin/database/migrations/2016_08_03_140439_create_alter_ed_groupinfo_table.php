<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterEdGroupinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `ed_groupinfo` ADD `group_id` VARCHAR(50) NOT NULL AFTER id");
		DB::statement("ALTER TABLE `ed_groupinfo` ADD `status` ENUM('0','1') DEFAULT '0' AFTER class_id ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_ed_groupinfo');
    }
}
