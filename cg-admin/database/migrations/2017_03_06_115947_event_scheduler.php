<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventScheduler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_scheduler', function (Blueprint $table) {
            DB::statement("ALTER TABLE `ed_event_scheduler` DROP `start_time`");
			DB::statement("ALTER TABLE `ed_event_scheduler` DROP `end_time`");
			DB::statement("ALTER TABLE `ed_event_scheduler` DROP `start_date`");
			DB::statement("ALTER TABLE `ed_event_scheduler` DROP `end_date`");
			DB::statement("ALTER TABLE `ed_event_scheduler` ADD `start_date` dateTime AFTER `token`");
			DB::statement("ALTER TABLE `ed_event_scheduler` ADD `end_date` dateTime AFTER `start_date`");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_scheduler', function (Blueprint $table) {
            //
        });
    }
}
