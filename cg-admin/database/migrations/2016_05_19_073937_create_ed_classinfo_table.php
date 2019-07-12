<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdClassinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_classinfo', function (Blueprint $table) {
            $table->increments('id',11);
			$table->string('class_name',100);
			$table->string('grade',100);
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
        Schema::drop('ed_classinfo');
    }
}
