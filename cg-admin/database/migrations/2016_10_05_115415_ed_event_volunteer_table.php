<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EdEventVolunteerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_event_volunteer', function (Blueprint $table) {
            $table->increments('id');
			$table->string('event_id',10);
			$table->string('teacher_ac_no',50);
			$table->string('class_id',50);
			$table->string('parent_ac_no',50);
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
        Schema::drop('ed_event_volunteer');
    }
}
