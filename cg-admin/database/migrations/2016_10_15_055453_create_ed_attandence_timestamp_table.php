<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdAttandenceTimestampTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `ed_attendance` DROP `updated_at`");
		DB::statement("ALTER TABLE `ed_attendance` DROP `created_at`");	
		DB::statement("ALTER TABLE `ed_event` DROP `schedule_date`");
		DB::statement("ALTER TABLE `ed_event` DROP `created_date`");
		DB::statement("ALTER TABLE `ed_event_schedule` DROP `updated_at`");
		DB::statement("ALTER TABLE `ed_event_schedule` DROP `created_at`");
		DB::statement("ALTER TABLE `ed_event_volunteer` DROP `updated_at`");
		DB::statement("ALTER TABLE `ed_event_volunteer` DROP `created_at`");
		DB::statement("ALTER TABLE `ed_assignment` DROP `submition_date`");
		DB::statement("ALTER TABLE `ed_assignment` DROP `created_date`");
		DB::statement("ALTER TABLE `ed_student_assignment` DROP `submition_date`");
	    DB::statement("ALTER TABLE `ed_attendance` ADD `created_at` DATE AFTER attendance");
		DB::statement("ALTER TABLE `ed_event` ADD `schedule_date` DATE AFTER volunteer_responsibility");
		DB::statement("ALTER TABLE `ed_event` ADD `created_at` DATE AFTER schedule_date");
		DB::statement("ALTER TABLE `ed_event_schedule` ADD `created_at` DATE AFTER status");
		DB::statement("ALTER TABLE `ed_event_schedule` ADD `updated_at` DATE AFTER created_at");
		DB::statement("ALTER TABLE `ed_event_volunteer` ADD `created_at` DATE AFTER status");
		DB::statement("ALTER TABLE `ed_event_volunteer` ADD `updated_at` DATE AFTER created_at");
		DB::statement("ALTER TABLE `ed_assignment` ADD `created_at` DATE AFTER status");
		DB::statement("ALTER TABLE `ed_assignment` ADD `submition_date` DATE AFTER created_at");
		DB::statement("ALTER TABLE `ed_student_assignment` ADD `submition_date` DATE AFTER status");
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ed_attandence_timestamp');
    }
}
