<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdStudentinfoPointDateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement("ALTER TABLE `ed_studentinfo_point` DROP `created_at`");
		DB::statement("ALTER TABLE `ed_studentinfo_point` DROP `updated_at`");	
		DB::statement("ALTER TABLE `ed_studentinfo_point` ADD `created_at` DATE AFTER customize_skills_id");
		DB::statement("ALTER TABLE `ed_studentinfo_point` ADD `updated_at` DATE AFTER created_at");
		DB::statement("ALTER TABLE `ed_teacher_student_remark` DROP `created_at`");
		DB::statement("ALTER TABLE `ed_teacher_student_remark` DROP `updated_at`");	
		DB::statement("ALTER TABLE `ed_teacher_student_remark` ADD `created_at` DATE AFTER remark");
		DB::statement("ALTER TABLE `ed_teacher_student_remark` ADD `updated_at` DATE AFTER created_at");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ed_studentinfo_point_date');
    }
}
