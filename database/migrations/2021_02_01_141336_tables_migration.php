<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablesMigration extends Migration
{
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_brand');
            $table->string('name')->nullable()->default('NULL');
            $table->string('address')->nullable()->default('NULL');
            $table->float('price');
            $table->text('description');
            $table->text('map');
            $table->longText('lat');
            $table->string('thumbnail')->nullable()->default(null);
            $table->string('gallery')->nullable()->default(null);
            $table->string('qrcode')->nullable()->default(null);
            $table->string('latitude')->nullable()->default(null);
            $table->string('longitude')->nullable()->default(null);
            $table->string('iban')->nullable()->default(null);
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
        Schema::dropIfExists('tables');
    }
}