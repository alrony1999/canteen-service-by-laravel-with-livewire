<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('food_id')->unsigned();

            $table->bigInteger('store_id')->unsigned();
            $table->bigInteger('deliverman_id')->unsigned()->nullable();
            $table->decimal('price');
            $table->integer('quantity');
            $table->decimal('discount')->default(0);
            $table->decimal('tax');
            $table->decimal('total');
            $table->string('name');
            $table->string('mobile');
            $table->string('email');
            $table->text('address');

            $table->enum('order_status', ['ordered', 'processing', 'ready', 'delivered', 'canceled'])->default('ordered');
            $table->enum('order_mode', ['pick-up', 'delivery']);
            $table->enum('deliveryman_status', ['no', 'picked', 'received', 'delivered',])->default('no');
            $table->boolean('review_status')->default(false);

            $table->timestamps();
            $table->foreign('food_id')->references('id')->on('food')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('canteen_store_names')->onDelete('cascade');
            $table->foreign('deliverman_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
