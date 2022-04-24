<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadCsvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_csv', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoice_no');
            $table->string('stock_code');
            $table->string('description')->nullable();
            $table->integer('quantity');
            $table->date('invoice_date');
            $table->double('unit_price', 15, 2);
            $table->integer('customer_id');
            $table->string('country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upload_csv');
    }
}
