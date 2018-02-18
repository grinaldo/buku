<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned()->nullable();
            $table->text('billing_address');
            $table->dateTime('transaction_date')->nullable();
            $table->string('transaction_no')->nullable();
            // should be on separate table
            $table->string('payment_method')->nullable();
            $table->boolean('pay_later')->boolean(false);
            // should be on separate table 
            $table->string('tags')->nullable();
            $table->text('memo')->nullable();

            $table->timestamps();

            $table->foreign('vendor_id')
                ->references('id')->on('vendors')
                ->onDelete('set null');
        });

        Schema::create('expenses_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expenses_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('tax_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('expenses_id')
                ->references('id')->on('expenses')
                ->onDelete('cascade');
            $table->foreign('account_id')
                ->references('id')->on('coas')
                ->onDelete('cascade');
            $table->foreign('tax_id')
                ->references('id')->on('taxes')
                ->onDelete('set null');
        });

        Schema::create('expenses_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expenses_id')->unsigned();
            $table->integer('file');

            $table->timestamps();

            $table->foreign('expenses_id')
                ->references('id')->on('expenses')
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
        Schema::dropIfExists('expenses_files');
        Schema::dropIfExists('expenses_accounts');
        Schema::dropIfExists('expenses');
    }
}
