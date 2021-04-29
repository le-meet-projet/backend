<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->date('date')->nullable();
		$table->integer('user_id')->nullable();
		$table->string('payment_method')->nullable()->default('NULL');
		$table->string('day')->nullable();
		$table->integer('hour')->nullable();
		$table->string('type')->nullable();
		$table->integer('capacity')->nullable();
		$table->string('status')->nullable();
		$table->integer('coupon_id')->nullable();
		$table->timestamps();
		$table->timestamp('deleted_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}