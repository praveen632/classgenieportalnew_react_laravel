<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterEdCustomizeSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            
       DB::statement("ALTER TABLE `ed_customize_skills` ADD `status` ENUM('0','1') DEFAULT '1' AFTER pointweight ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_ed_customize_skills');
    }
}
