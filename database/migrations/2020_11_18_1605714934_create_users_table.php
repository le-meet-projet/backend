<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->string('name');
		$table->string('email');
		$table->timestamp('email_verified_at')->nullable();
		$table->string('password');
		$table->string('remember_token')->nullable()->default('NULL');
		$table->text('address')->nullable();
		$table->string('status')->nullable()->default('NULL');
		$table->string('avatar')->nullable()->default(null);
		$table->string('phone')->nullable()->default('NULL');
		$table->string('role')->nullable()->default('NULL');
		$table->timestamps();
		$table->date('deleted_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
