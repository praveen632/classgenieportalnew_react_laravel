<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdGroupinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_groupinfo', function (Blueprint $table) {
            $table->increments('id',11);
			$table->string('group_name',100);
			$table->string('student_no',100);
			$table->string('student_name',100);
			$table->string('image',100);
			$table->integer('pointweight');
			$table->string('member_no',12)->default('');
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
        Schema::drop('ed_groupinfo');
    }
}
