<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement("DROP TABLE ed_event");
	   DB::statement("DROP TABLE ed_event_schedule");
	   DB::statement("DROP TABLE ed_event_volunteer");
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drop_event', function (Blueprint $table) {
            //
        });
    }
}
