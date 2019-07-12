<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdEventFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_event_feedback', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('event_id');
			$table->text('description');
			$table->string('member_no',50);
			$table->enum('status', ['0', '1'])->default('1');
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
        Schema::drop('ed_event_feedback');
    }
}
