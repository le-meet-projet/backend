<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingTable extends Migration
{
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {

        $table->bigIncrements('id');
		$table->date('date')->nullable();
		$table->integer('user_id')->nullable();
		$table->timestamps();
		$table->timestamp('deleted_at')->nullable();;

        });
    }

    public function down()
    {
        Schema::dropIfExists('rating');
    }
}