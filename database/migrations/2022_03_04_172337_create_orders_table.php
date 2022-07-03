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
            //The articleCount Column explans, how much the Customer has ordered 
            $table->integer('articleCount');
            //The toDeliverCount Column explans, how much Articles the Driver should deliver 
            $table->integer('toDeliverCount')->nullable();
            //Customer can value the Article with Stars
            $table->integer('stars')->nullable();
            //The orderDelivered Column accepts one Value 'no' or 'yes'
            $table->string('orderDelivered')->nullable();
            //The customerAccept Column accepts one of three Values 'no', 'yes' or 'damaged'
            $table->string('customerAccept')->nullable();
            //Count of demaged Article, used from Driver
            $table->integer('demagedArticle')->nullable();
            //This Column shows you the Count of the Articles, they the Customer accepted
            $table->integer('yesAcceptCount')->nullable();
            //This Column shows you the Count of the Articles, they the Customer did NOT accept
            $table->integer('noAcceptCount')->nullable();
            //This Column shows you the Count of the Articles, they the Customer accepted demaged
            $table->integer('demagedAcceptCount')->nullable();
            //'Admin' or 'Driver' can cancle the Order.This column accepts Value 'admin' or 'driver'
            $table->string('cancelDecision')->nullable();
            //The reasonCancel explans the Reason of the ProductsCancel.The Value can be 'damaged' or 'want from customer'
            $table->string('reasonCancel')->nullable();
            //In this Column cann put the Admin, how many orderdArticles want to cancel
            $table->integer('cancelCount')->nullable();
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
