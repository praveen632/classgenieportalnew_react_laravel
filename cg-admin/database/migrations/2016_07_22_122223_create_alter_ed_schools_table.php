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
        DB::statement("ALTER TABLE `ed_schools` ADD `city` VARCHAR(50) NOT NULL AFTER address ");
		DB::statement("ALTER TABLE `ed_schools` ADD `state` VARCHAR(50) NOT NULL AFTER city ");
		DB::statement("ALTER TABLE `ed_schools` ADD `country` VARCHAR(50) NOT NULL AFTER state ");
		DB::statement("ALTER TABLE `ed_schools` ADD `pincode` INT(10) DEFAULT 0 AFTER country ");
		DB::statement("ALTER TABLE `ed_schools` ADD `status` ENUM('0','1') DEFAULT '0' AFTER pincode ");
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
