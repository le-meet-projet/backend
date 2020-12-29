<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpacesTable extends Migration
{
    public function up()
    {
        Schema::create('spaces', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->int('id_brand');
			$table->string('name')->nullable()->default('NULL');
			$table->string('address')->nullable()->default('NULL');
			$table->text('description');
			$table->text('map');
			$table->string('thumbnail')->nullable()->default('NULL');
			$table->string('gallery')->nullable()->default('NULL');
			$table->string('type')->nullable()->default('NULL');
			$table->string('type_space')->nullable()->default('NULL');
			$table->string('post_type')->nullable()->default('NULL');
			$table->string('activity_type')->nullable()->default('NULL');
			$table->string('reservation_type')->nullable()->default('NULL');
			$table->string('repetition_type')->nullable()->default('NULL');
			$table->string('period')->nullable()->default('NULL');
			$table->string('percent')->nullable()->default('NULL');
			$table->string('ads')->nullable()->default('NULL');
			$table->string('city')->nullable()->default('NULL');
			$table->date('date')->nullable();
			$table->time('time')->nullable();
			$table->string('capacity')->nullable();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('spaces');
    }
}