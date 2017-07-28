<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('booking_id');
            $table->bigInteger('vendor_id', false, true)->length(20); 
            $table->text('data');
            $table->timestamp('created_on')->nullable();
            $table->timestamp('date_paid')->nullable();    
            $table->bigInteger('invoice_id', false, true)->length(20);
            $table->timestamp('last_modified')->nullable();
            $table->decimal('value', 10,0);
            $table->decimal('commission_value', 10,0);
            $table->tinyInteger('status', false, true)->length(2);
            $table->integer('status_marker',  false, true)->length(11);
            $table->tinyInteger('paid',  false, true)->length(2);
            $table->decimal('commission_paid', 10,0);    
            $table->decimal('customer_acc', 10,0);   
            $table->decimal('customer_expects', 10,0); 
            $table->decimal('hotelsng_acc', 10,0);   
            $table->decimal('hotelsng_expects', 10,0);  
            $table->decimal('vendor_acc', 10,0); 
            $table->decimal('vendor_expects', 10,0);  
            $table->decimal('fees_paid', 10,0);
            $table->string('vendor_state', 100); 
            $table->string('vendor_city', 100);     
            $table->string('vendor_name', 100); 
            $table->string('for_fname', 100);
            $table->string('for_lname', 100);
            $table->dateTime('date_handled');
            $table->string('finance_handler', 100);
            $table->string('booking_handler', 100);
            $table->string('bank_paid_into', 100);
            $table->decimal('amount_customer_paid', 10, 0);
            $table->dateTime('time_paid_in');
            $table->dateTime('date_customer_paid');
            $table->decimal('amount_paid_to_hotel', 10,0);
            $table->string('commission_earned', 100);
            $table->dateTime('checkin');    
            $table->dateTime('checkout');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
