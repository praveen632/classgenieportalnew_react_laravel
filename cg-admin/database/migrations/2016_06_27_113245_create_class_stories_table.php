<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_class_stories', function (Blueprint $table) {
            $table->increments('id');
			$table->string('image',100);
			$table->text('message')->nullable();
            $table->string('member_no',100);
			$table->string('class_id',100);
            $table->enum('status', ['0', '1', '-1'])->default('0');
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
        Schema::drop('ed_class_stories');
    }
}
