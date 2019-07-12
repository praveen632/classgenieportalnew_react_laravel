<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_class_comments', function (Blueprint $table) {
            $table->increments('id');
			$table->string('story_id',50);
			$table->text('comment')->nullable();
			$table->string('member_no',100);
			$table->string('class_id',100);
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
        Schema::drop('ed_class_comments');
    }
}
