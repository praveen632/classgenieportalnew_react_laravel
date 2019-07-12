<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterEdAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement("ALTER TABLE `ed_attendance` DROP COLUMN `created_at`");
	   DB::statement("ALTER TABLE `ed_attendance` DROP COLUMN `updated_at`");
	   DB::statement("ALTER TABLE `ed_attendance` ADD `created_at` VARCHAR(50) NOT NULL AFTER attendance");
	   DB::statement("ALTER TABLE `ed_attendance` ADD `updated_at` VARCHAR(50) NOT NULL AFTER created_at");
       DB::statement("ALTER TABLE `ed_groupinfo` DROP COLUMN `group_name`");
	   DB::statement("ALTER TABLE `ed_reffer_teacher` DROP COLUMN `status`");
	   DB::statement("RENAME TABLE `ed_reffer_teacher` TO `ed_refer_teacher`");
	   
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_ed_attendance');
    }
}
