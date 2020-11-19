<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->integer('code')->nullable();
		$table->string('discount_type')->nullable()->default('NULL');
		$table->string('discount')->nullable()->default('NULL');
		$table->string('title')->nullable()->default('NULL');
		$table->text('description');
		$table->tinyInteger('statue')->nullable();
		$table->timestamps();
		$table->timestamp('deleted_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}