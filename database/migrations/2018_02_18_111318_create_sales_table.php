<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->nullable();
            $table->string('email')->nullable();
            $table->text('billing_address');
            $table->dateTime('transaction_date')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->string('terms')->nullable();
            $table->string('transaction_no')->nullable();
            // should be on separate table 
            $table->string('tags')->nullable();
            $table->string('customer_ref_no')->nullable();
            $table->text('message')->nullable();
            $table->text('memo')->nullable();

            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')->on('customers')
                ->onDelete('set null');
        });

        Schema::create('sales_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('tax_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('sales_id')
                ->references('id')->on('sales')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');
            $table->foreign('tax_id')
                ->references('id')->on('taxes')
                ->onDelete('set null');
        });

        Schema::create('sales_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_id')->unsigned();
            $table->integer('file');

            $table->timestamps();

            $table->foreign('sales_id')
                ->references('id')->on('sales')
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
        Schema::dropIfExists('sales_files');
        Schema::dropIfExists('sales_products');
        Schema::dropIfExists('sales');
    }
}
