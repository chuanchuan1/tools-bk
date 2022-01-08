<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlibabaOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alibaba_orders', function (Blueprint $table) {
            $table->id();
            $table->string("order_number")->nullable();
            $table->string("buyer_company")->nullable();
            $table->string("buyer_name")->nullable();
            $table->string("seller_company")->nullable();
            $table->string("seller_name")->nullable();
            $table->decimal('total_price', 8, 2)->nullable();
            $table->decimal('freight', 8, 2)->nullable();
            $table->decimal('discount', 8, 2)->nullable();
            $table->decimal('actual_payment', 8, 2)->nullable();
            $table->string("order_status")->nullable();
            $table->string('order_created_at')->nullable();
            $table->string("order_pay_created_at")->nullable();
            $table->string("shipper")->nullable();
            $table->string("addressee_name")->nullable();
            $table->string("addressee_address")->nullable();
            $table->string("postal_code")->nullable();
            $table->string("addressee_phone")->nullable();
            $table->string("addressee_mobile")->nullable();
            $table->string("goods_title")->nullable();
            $table->string("unit_price")->nullable();
            $table->integer("amount")->nullable();
            $table->string("unit")->nullable();
            $table->string("goods_code")->nullable();
            $table->string("model")->nullable();
            $table->string("offer_id")->nullable();
            $table->string("sku_id")->nullable();
            $table->string("material_item_no")->nullable();
            $table->string("single_product_item_no")->nullable();
            $table->string("goods_cate")->nullable();
            $table->string("buyer_leaving_message")->nullable();
            $table->string("fms_number")->nullable();
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
        Schema::dropIfExists('alibaba_orders');
    }
}
