<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdEventSchedulerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_event_scheduler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
			$table->date('start_date');
			$table->date('end_date');
			$table->time('start_time');
			$table->time('end_time');
						
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ed_event_scheduler');
    }
}
