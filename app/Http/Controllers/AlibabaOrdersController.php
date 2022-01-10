<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\AlibabaOrdersImport;
use App\Models\AlibabaOrder;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AlibabaOrdersController extends Controller
{
    public function getOrderByPhone (Request $request) {
        if ($request->has("search")) {
            $data = AlibabaOrder::where('addressee_mobile', 'like', '%' . $request->search . '%')
                ->orWhere('addressee_name', 'like', '%' . $request->search . '%')
                ->orWhere('order_number', 'like', '%' . $request->search . '%')
                ->orWhere('fms_number', 'like', '%' . $request->search . '%')
                ->get();
            return $data;
        } else {
            return "输入关键字";
        }
    }

    public function index (Request $request) {
        if ($request->has('limit')) {
            $data = AlibabaOrder::where('addressee_mobile', 'like', '%' . $request->search . '%')
            ->orWhere('addressee_name', 'like', '%' . $request->search . '%')
            ->orWhere('order_number', 'like', '%' . $request->search . '%')
            ->paginate($request->limit);
        } else {
            $data = AlibabaOrder::where('addressee_mobile', 'like', '%' . $request->search . '%')
                ->orWhere('addressee_name', 'like', '%' . $request->search . '%')
                ->orWhere('order_number', 'like', '%' . $request->search . '%')
                ->paginate(10);
        }

        return $data;
    }

    public function import (Request $request) {
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

        AlibabaOrder::truncate();

        Excel::import(new AlibabaOrdersImport, './uploads/' . date('Ymd') . "/" . $filename);

        return "successd";
    }
}
