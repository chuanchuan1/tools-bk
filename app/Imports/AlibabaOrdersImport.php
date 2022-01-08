<?php

namespace App\Imports;

use App\Models\AlibabaOrder;
use Maatwebsite\Excel\Concerns\ToModel;

class AlibabaOrdersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row[0] == "订单编号") {
            return;
        }
        return new AlibabaOrder([
            "order_number" =>  $row[0],
            "buyer_company" =>  $row[1],
            "buyer_name" =>  $row[2],
            "seller_company" =>  $row[3],
            "seller_name" =>  $row[4],
            'total_price' =>  $row[5],
            'freight' =>  $row[6],
            'discount' =>  $row[7],
            'actual_payment' =>  $row[8],
            "order_status" =>  $row[9],
            'order_created_at' =>  $row[10],
            "order_pay_created_at" =>  $row[11],
            "shipper" =>  $row[12],
            "addressee_name" =>  $row[13],
            "addressee_address" =>  $row[14],
            "postal_code" =>  $row[15],
            "addressee_phone" =>  $row[16],
            "addressee_mobile" =>  $row[17],
            "goods_title" =>  $row[18],
            "unit_price" =>  $row[19],
            "amount" =>  $row[20],
            "unit" =>  $row[21],
            "goods_code" =>  $row[22],
            "model" =>  $row[23],
            "offer_id" =>  $row[24],
            "sku_id" =>  $row[25],
            "material_item_no" =>  $row[26],
            "single_product_item_no" =>  $row[27],
            "goods_cate" =>  $row[28],
            "buyer_leaving_message" =>  $row[29],
            "fms_number" =>  $row[30],
        ]);
    }
}
