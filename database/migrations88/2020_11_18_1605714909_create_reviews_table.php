<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {

        $table->bigIncrements('id');
		$table->integer('user_id')->nullable();
		$table->text('review');
		$table->string('rating')->nullable()->default('NULL');
		$table->timestamps();
		$table->timestamp('deleted_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}