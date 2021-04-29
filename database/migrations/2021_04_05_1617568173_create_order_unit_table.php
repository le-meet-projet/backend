<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderUnitTable extends Migration
{
    public function up()
    {
        Schema::create('order_unit', function (Blueprint $table) {

		$table->integer('id',11);
		$table->string('unique_id')->nullable()->default('NULL');
		$table->string('order_id')->nullable()->default('NULL');
		$table->string('order_date')->nullable()->default('NULL');
		$table->string('order_time')->nullable()->default('NULL');
		$table->string('order_from')->nullable()->default('NULL');
		$table->string('order_to')->nullable()->default('NULL');
		$table->string('chaire_count')->nullable()->default('NULL');
		$table->string('type')->nullable()->default('NULL');
		$table->string('type_id')->nullable()->default('NULL');
		$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    public function down()
    {
        Schema::dropIfExists('order_unit');
    }
}