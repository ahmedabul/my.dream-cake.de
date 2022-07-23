<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('invoice_id');
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->tinyInteger('ready')->default('0');
            //Was the order delivered? True 1, False 0. Default is 0
            $table->tinyInteger('delivered')->default('0');
            //had accepted The Customer his Article? True 1, False 0. Default is 0
            $table->tinyInteger('accept')->default('0');
            //The Customer had Not accept his Article. True 1, False 0. Default is 0
            $table->tinyInteger('noAccept')->default('0');
            //Was the Article damaged? True 1, False 0. Default is 0
            $table->tinyInteger('damaged')->default('0');
            //The tryCount Column shows the count of Try of delivery this Order
            $table->integer('tryCount')->nullable();
            //Customer can value the Article with Stars
            $table->integer('stars')->nullable();
            //'Admin' or 'Driver' can cancle the Order.This column accepts Value 'admin' or 'driver'
            $table->string('cancelDecision')->nullable();
            //The reasonCancel explans the Reason of the ProductsCancel.The Value can be 'damaged' or 'want from customer'
            $table->string('reasonCancel')->nullable();
            //In this Column cann explan the Admin, how he removed the Problem
            $table->text('adminReaktion')->nullable();
            //This Column explans, where the Driver delivered the Article. For examble 'at Neighbar or at Customer'
            $table->string('articlePlace')->nullable();
            //This Column shows you the Commints from Custommer for Examble 'Evaluate of Article' or 'Complaint'
            $table->text('customerComment')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
