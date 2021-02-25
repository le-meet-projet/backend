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
		$table->string('name')->nullable()->default(null);
		$table->text('address');
		$table->text('description');
		$table->string('thumbnail')->nullable()->default(null);
		$table->json('gallery')->nullable()->default(null);
		$table->json('files')->nullable()->default(null);
		$table->timestamps();
		$table->timestamp('deleted_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('brands');
    }
}