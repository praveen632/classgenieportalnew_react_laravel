<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdCustomizeSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_customize_skills', function (Blueprint $table) {
            $table->increments('id',11);
			$table->string('name',100);
			$table->string('pointweight',100);
			$table->string('image',100);
			$table->string('class_id',50);
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
        Schema::drop('ed_CustomizeSkills');
    }
}
