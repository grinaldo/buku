<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned()->nullable();
            $table->string('email')->nullable();
            $table->text('billing_address');
            $table->dateTime('transaction_date')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->string('terms')->nullable();
            $table->string('transaction_no')->nullable();
            // should be on separate table 
            $table->string('tags')->nullable();
            $table->string('vendor_ref_no')->nullable();
            $table->text('message')->nullable();
            $table->text('memo')->nullable();

            $table->timestamps();

            $table->foreign('vendor_id')
                ->references('id')->on('vendors')
                ->onDelete('set null');
        });

        Schema::create('purchases_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchases_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('tax_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('purchases_id')
                ->references('id')->on('purchases')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');
            $table->foreign('tax_id')
                ->references('id')->on('taxes')
                ->onDelete('set null');
        });

        Schema::create('purchases_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchases_id')->unsigned();
            $table->integer('file');

            $table->timestamps();

            $table->foreign('purchases_id')
                ->references('id')->on('purchases')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases_files');
        Schema::dropIfExists('purchases_products');
        Schema::dropIfExists('purchases');
    }
}
