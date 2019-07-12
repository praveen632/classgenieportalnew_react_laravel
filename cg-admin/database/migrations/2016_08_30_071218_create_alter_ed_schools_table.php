<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterEdSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `ed_schools` DROP `status`");	
	    DB::statement("ALTER TABLE `ed_schools` ADD `status` ENUM('0','1','-1') DEFAULT '0' AFTER phone ");
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_ed_schools');
    }
}
