<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ed_users', function (Blueprint $table) {
            $table->bigInteger('id', 20);
			$table->string('name',100);
			$table->string('username',100);
            $table->string('email',100);
			$table->string('password',100);
            $table->string('phone',100);
			$table->string('age',100);
			$table->string('image',100);
			$table->string('member_no',12);
			$table->enum('status', ['Active', 'Inactive'])->default('active');
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
        Schema::drop('ed_users');
    }
}
