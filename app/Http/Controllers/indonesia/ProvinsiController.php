<?php

namespace App\Http\Controllers\indonesia;

use App\Http\Controllers\Controller;
use App\Repositories\indonesia\ProvinsiRepository;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function getAllData()
    {
        $data = (new ProvinsiRepository())->aksiGetAll();
        return $data;
    }
    public function getPostData(Request $request)
    {
        $data = [
            'provinsi_id' => $request->input('provinsi_id'),
            'nama' => $request->input('nama'),
            'umum' => $request->input('umum'),
            'iso' => $request->input('iso'),
        ];
        $data = (new ProvinsiRepository())->aksiGetPostData($data);
        return $data;
    }

    public function getSearchData($provinsiId)
    {
        $data = [
            'provinsi_id' => $provinsiId,
        ];
        $data = (new ProvinsiRepository())->aksiGetSearch($data);
        return $data;
    }
}
