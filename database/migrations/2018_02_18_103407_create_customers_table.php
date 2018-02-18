<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name');
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            // address
            $table->text('billing_address')->nullable();
            $table->string('address_no')->nullable();
            $table->string('address_no_rt')->nullable();
            $table->string('address_no_rw')->nullable();
            $table->string('address_zipcode')->nullable();
            $table->string('address_subdistrict')->nullable();
            $table->string('addres_city')->nullable();
            $table->string('address_province')->nullable();
            $table->string('shipping_address')->nullable();
            // contacts
            $table->string('email')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('text')->nullable();
            $table->text('description')->nullable();
            // chart account
            $table->integer('account_receivable_id')->unsigned()->nullable();
            $table->integer('account_payable_id')->unsigned()->nullable();
            $table->float('maximum_receivable');
            // should be id
            // e.g: NET 15, NET 30, NET 60, COD (listed on table)
            $table->string('payment_term');

            $table->timestamps();

            $table->foreign('account_receivable_id')
                ->references('id')->on('coas')
                ->onDelete('set null');
            $table->foreign('account_payable_id')
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
        Schema::dropIfExists('customers');
    }
}
