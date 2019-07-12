<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventResponsibilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_event_responsibility', function (Blueprint $table) {
            $table->increments('id');
            $table->text('responsibilty');
            $table->string('created_date',50);
            $table->string('updated_date',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ed_event_responsibility');
    }
}
