<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterStudentinfoPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement("ALTER TABLE `ed_studentinfo_point` DROP COLUMN `created_at`");
	   DB::statement("ALTER TABLE `ed_studentinfo_point` DROP COLUMN `updated_at`");
	   DB::statement("ALTER TABLE `ed_studentinfo_point` ADD `created_at` VARCHAR(50) NOT NULL AFTER customize_skills_id");
	   DB::statement("ALTER TABLE `ed_studentinfo_point` ADD `updated_at` VARCHAR(50) NOT NULL AFTER created_at");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_studentinfo_point');
    }
}
