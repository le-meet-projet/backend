<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIbanBankTypeToBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->string('iban')->nullable()->after('files');
            $table->string('bank')->nullable()->after('iban');
            $table->enum('type', ['hotel', 'restaurant', 'workspace', 'coffee'])->nullable()->after('bank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('iban');
            $table->dropColumn('bank');
            $table->dropColumn('type');
        });
    }
}
