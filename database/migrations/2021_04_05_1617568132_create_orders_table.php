<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('lemeet_orders', function (Blueprint $table) {

		$table->integer('id',11);
		$table->string('user_id')->nullable()->default('NULL');
		$table->string('type')->nullable()->default('NULL');
		$table->string('type_id')->nullable()->default('NULL');
		$table->string('price')->nullable()->default('NULL');
		$table->string('promo_code')->nullable()->default('NULL');
		$table->string('payment_method')->nullable()->default('NULL');
		$table->string('payment_id')->nullable()->default('NULL');
		$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
	//	$table->timestamp('updated_at')->nullable()->default('NULL');
		$table->string('latitude')->nullable()->default('NULL');
		$table->string('longitude')->nullable()->default('NULL');
		$table->string('ip')->nullable()->default('NULL');

		/*
id
user_id
type
type_id
price
promo_code
payment_method
payment_id
latitude
longitude
ip

		*/
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}