<?php

namespace App\Http\Controllers;

use App\Imports\ExpressImport;
use App\Models\Express;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExpressController extends Controller
{
    public function import(Request $request) {
        if ($request->isMethod('POST')){
            $file = $request->file('file');
            // 判断文件是否上传成功
            if ($file->isValid()){
                // 原文件名
                $originalName = $file->getClientOriginalName();
                // 扩展名
                $ext = $file->getClientOriginalExtension();
                // MimeType
                $type = $file->getClientMimeType();
                // 临时绝对路径
                $realPath = $file->getRealPath();
                $filename = uniqid().'.'.$ext;
                $bool = Storage::disk('uploads')->put($filename,file_get_contents($realPath));
            }
        }

        Express::truncate();

        Excel::import(new ExpressImport, './uploads/' . $filename);

        return "successd";
    }

    public function getExpressByPhone (Request $request) {
        $express = new Express();
        if ($request->has("order_number")) {
            $express = $express->where('order_number', $request->order_number);
        } elseif ($request->has("express_number")) {
            $temp = Express::where('express_number', $request->express_number)->first();
            if (! empty($temp)) {
                $orderNumber = $temp->order_number;
                $express = $express->where('order_number', $orderNumber);
            } else {
                return [];
            }
        } else {
            return [];
        }

        return $express->get();
    }

    public function index (Request $request) {
        if ($request->has('limit')) {
            $data = Express::where('order_number', 'like', '%' . $request->search . '%')
            ->orWhere('express_number', 'like', '%' . $request->search . '%')
            ->paginate($request->limit);
        } else {
            $data = Express::where('order_number', 'like', '%' . $request->search . '%')
                ->orWhere('express_number', 'like', '%' . $request->search . '%')
                ->paginate(10);
        }

        return $data;
    }
}
