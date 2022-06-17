<?php

namespace App\Http\Controllers\indonesia;

use App\Helpers\ResponsesHelpers;
use App\Http\Controllers\Controller;
use App\Repositories\indonesia\KepulauanRepository;
use Illuminate\Http\Request;

class KepulauanController extends Controller
{
    public function getAllData()
    {
        $data = (new KepulauanRepository())->aksiGetAll();
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
        $data = (new KepulauanRepository())->aksiGetPostData($data);
        return $data;
    }

    public function getSearchData(Request $request)
    {
        $data = [
            'cari' => $request->input('cari'),
        ];

        // dd($data);
        $data = (new KepulauanRepository())->aksiGetSearch($request);
        return $data;
    }
}
