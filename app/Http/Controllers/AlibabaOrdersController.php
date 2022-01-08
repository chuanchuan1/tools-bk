<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\AlibabaOrdersImport;
use App\Models\AlibabaOrder;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AlibabaOrdersController extends Controller
{
    public function index () {
        return AlibabaOrder::all();
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

        Excel::import(new AlibabaOrdersImport, './uploads/' . date('Ymd') . "/" . $filename);

        return redirect('/')->with('success', 'All good!');
    }
}
