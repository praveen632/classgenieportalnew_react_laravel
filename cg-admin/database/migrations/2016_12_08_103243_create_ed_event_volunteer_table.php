<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdEventVolunteerTable extends Migration
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
			$table->integer('event_id');
			$table->string('member_no',50);
			$table->enum('status', ['0', '1','2'])->default('0');
			$table->date('created_date');
			$table->date('update_date');
			          
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
