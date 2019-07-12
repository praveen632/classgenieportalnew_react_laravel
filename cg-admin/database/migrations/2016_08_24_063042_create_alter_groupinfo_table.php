<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterGroupinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::statement("ALTER TABLE `ed_group` ADD `class_id` varchar(50)");
         DB::statement("ALTER TABLE `ed_group` ADD `pointweight` int(11) DEFAULT 0 AFTER class_id ");
		 DB::statement("ALTER TABLE `ed_groupinfo` DROP COLUMN `pointweight`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_groupinfo');
    }
}
