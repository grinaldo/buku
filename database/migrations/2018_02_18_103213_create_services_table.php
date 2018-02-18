<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('product_unit_id')->unsigned()->nullable();
            $table->integer('product_category_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('code');
            $table->string('image')->nullable();
            $table->text('description'); 
            $table->float('purchase_price');
            $table->integer('purchase_tax_id')->unsigned()->nullable();
            $table->integer('purchase_account_id')->unsigned()->nullable();
            $table->float('sale_price');
            $table->integer('sale_tax_id')->unsigned()->nullable();
            $table->integer('sale_account_id')->unsigned()->nullable();
            $table->boolean('is_tracked')->default(false);
            $table->float('stock')->default(0);
            $table->float('stock_alert')->default(0);
            $table->integer('inventory_account_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
            $table->foreign('product_category_id')
                ->references('id')->on('product_categories')
                ->onDelete('set null');
            $table->foreign('product_unit_id')
                ->references('id')->on('users')
                ->onDelete('set null');
            $table->foreign('sale_account_id')
                ->references('id')->on('coas')
                ->onDelete('set null');
            $table->foreign('purchase_account_id')
                ->references('id')->on('coas')
                ->onDelete('set null');
            $table->foreign('sale_tax_id')
                ->references('id')->on('taxes')
                ->onDelete('set null');
            $table->foreign('purchase_tax_id')
                ->references('id')->on('taxes')
                ->onDelete('set null');
            $table->foreign('inventory_account_id')
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
        Schema::dropIfExists('services');
    }
}
