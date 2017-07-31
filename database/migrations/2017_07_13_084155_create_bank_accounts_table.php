<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bank_id', false, true)->lenght(11);
            $table->string('bank_name', 100);
            $table->string('account_name', 100);
            $table->string('account_number', 100);
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('email', 100);
            $table->string('phonenumber', 100);
            $table->string('description', 100);
            $table->string('card_no', 30);
            $table->string('cvv', 10);
            $table->string('expiry_year', 10);
            $table->string('expiry_month', 10);
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
        Schema::dropIfExists('bank_accounts');
    }
}
