<?php

namespace App\Imports;

use App\Models\Express;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log;

class ExpressImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row[0] == "原始单号") {
            return;
        }
        return new Express([
            "order_number" =>  $row[0],
            "express_number" => $row[2],
            'send_time' =>  $row[1],
            "goods_intro" => $row[3],
            "goods_num" => $row[4]
        ]);
    }
}
