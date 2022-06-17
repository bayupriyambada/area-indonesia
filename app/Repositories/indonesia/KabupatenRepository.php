<?php

namespace App\Repositories\indonesia;

use App\Models\indonesia\KabupatenModel;
use Illuminate\Support\Str;

class KabupatenRepository
{
    public function aksiGetAll()
    {
        return KabupatenModel::all();
    }

    public function aksiGetPostData($params)
    {
        $nama = isset($params['nama']) ? $params['nama'] : '';

        if (strlen($nama) == 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'nama tidak boleh kosong',
            ]);
        }

        $provinsiId = (new ProvinsiRepository())->aksiGetPostData($params);
        if (!$provinsiId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Provinsi tidak ditemukan',
            ]);
        }

        $kabupatenId = isset($params['kabupaten_id'])
            ? $params['kabupaten_id']
            : '';
        if (strlen($kabupatenId) == 0) {
            $data = new KabupatenModel();
        } else {
            $data = KabupatenModel::find($kabupatenId);
            if (!$data) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kabupaten tidak ditemukan',
                ]);
            }
        }

        $data->nama = Str::upper($nama);
        $data->slug = Str::slug($nama);
        $data->provinsi_id = $provinsiId;
        $data->save();
    }
}
