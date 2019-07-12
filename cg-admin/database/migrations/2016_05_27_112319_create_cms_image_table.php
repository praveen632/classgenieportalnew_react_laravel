<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_image', function (Blueprint $table) {
            $table->increments('id');
			$table->string('title',100);
			$table->string('image',100);
			$table->tinyInteger('type');
			$table->tinyInteger('order');
			$table->enum('status', ['0','1'])->default('1');
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
        Schema::drop('cms_image');
    }
}
