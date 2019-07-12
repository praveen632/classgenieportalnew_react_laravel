<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdEventTable extends Migration
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
			$table->integer('no_of_volunteer');
			$table->string('class_id',50);
			$table->string('teacher_ac_no',50);
			$table->enum('status', ['0', '1','2'])->default('0');
			$table->string('volunteer_responsibility',100);
			$table->date('created_date');
			$table->date('schedule_date');
			           
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
