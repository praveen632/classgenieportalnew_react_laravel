<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdClassStorieLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_class_storie_like', function (Blueprint $table) {
            $table->increments('id');
			$table->string('story_id',10);
			$table->string('member_no',50);
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
        Schema::drop('ed_class_storie_like');
    }
}
