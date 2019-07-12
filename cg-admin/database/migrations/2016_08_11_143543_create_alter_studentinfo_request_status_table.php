<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterStudentinfoRequestStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		DB::statement("ALTER TABLE `ed_studentinfo` DROP COLUMN `request_status`");
        DB::statement("ALTER TABLE `ed_studentinfo` ADD `request_status` ENUM('0','1','-1') DEFAULT '0' AFTER status ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_studentinfo_request_status');
    }
}
