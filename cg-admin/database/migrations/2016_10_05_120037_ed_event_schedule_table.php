<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EdEventScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_event_schedule', function (Blueprint $table) {
            $table->increments('id');
			$table->string('event_id',10);
			$table->string('start_schedule_event',50);
			$table->string('end_schedule_event',50);
			$table->enum('status', ['0', '1','2'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ed_event_schedule');
    }
}
