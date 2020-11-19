<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->string('name')->nullable()->default('NULL');
		$table->text('adress');
		$table->text('description');
		$table->string('thumbnail')->nullable()->default('NULL');
		$table->string('gallery')->nullable()->default('NULL');
		$table->timestamps();
		$table->timestamp('deleted_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('brands');
    }
}