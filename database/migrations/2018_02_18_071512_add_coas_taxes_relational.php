<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoasTaxesRelational extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coas', function (Blueprint $table) {
            $table->integer('default_tax_id')->unsigned()->nullable();

            $table->foreign('default_tax_id')
                ->references('id')->on('taxes')
                ->onDelete('set null');
        });

        Schema::table('taxes', function (Blueprint $table) {
            $table->integer('sale_account_id')->unsigned()->nullable();
            $table->integer('purchase_account_id')->unsigned()->nullable();

            $table->foreign('sale_account_id')
                ->references('id')->on('coas')
                ->onDelete('set null');
            $table->foreign('purchase_account_id')
                ->references('id')->on('coas')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coas', function (Blueprint $table) {
            $table->dropForeign(['default_tax_id']);

            $table->dropColumn('default_tax_id');
        });

        Schema::table('taxes', function (Blueprint $table) {
            $table->dropForeign(['sale_account_id']);
            $table->dropForeign(['purchase_account_id']);

            $table->dropColumn('sale_account_id');
            $table->dropColumn('purchase_account_id');
        });
    }
}
