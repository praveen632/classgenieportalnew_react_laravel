<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        DB::statement("ALTER TABLE `cms_content` ADD `metakey` text   AFTER description");
         DB::statement("ALTER TABLE `cms_content` ADD `metadesc` text   AFTER metakey");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alter_content');
    }
}
