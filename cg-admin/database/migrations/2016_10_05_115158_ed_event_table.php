<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EdEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_event', function (Blueprint $table) {
            $table->increments('id');
			$table->string('event_name',250);
			$table->text('description');
			$table->string('no_of_volunteer',10);
			$table->string('class_id',50);
			$table->string('teacher_ac_no',50);
			$table->enum('status', ['0', '1','2'])->default('0');
			$table->string('volunteer_responsibility',100);
			$table->string('created_date',50);
			$table->string('schedule_date',50);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ed_event');
    }
}
