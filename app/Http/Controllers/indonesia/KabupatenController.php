<?php

namespace App\Http\Controllers\indonesia;

use App\Http\Controllers\Controller;
use App\Repositories\indonesia\KabupatenRepository;
use App\Repositories\indonesia\ProvinsiRepository;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function getAllData()
    {
        $data = (new KabupatenRepository())->aksiGetAll();
        return $data;
    }
    public function getPostData(Request $request)
    {
        $data = [
            'kabupaten_id' => $request->input('kabupaten_id'),
            'nama' => $request->input('nama'),
            'provinsi_id' => $request->input('provinsi_id'),
        ];
        $data = (new KabupatenRepository())->aksiGetPostData($data);
        return $data;
    }
}
