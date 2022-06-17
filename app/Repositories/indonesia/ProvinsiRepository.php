<?php

namespace App\Repositories\indonesia;

use Illuminate\Support\Str;
use App\Helpers\ResponsesHelpers;
use App\Models\indonesia\ProvinsiModel;

class ProvinsiRepository
{
    public function aksiGetAll()
    {
        $data = ProvinsiModel::query()->get();
        return ResponsesHelpers::getResponseSucces(200, $data);
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
        $umum = isset($params['umum']) ? $params['umum'] : '';

        if (strlen($umum) == 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'umum provinsi tidak boleh kosong',
            ]);
        }
        $iso = isset($params['iso']) ? $params['iso'] : '';

        if (strlen($iso) == 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'iso provinsi tidak boleh kosong',
            ]);
        }

        $provinsiId = isset($params['provinsi_id'])
            ? $params['provinsi_id']
            : '';
        if (strlen($provinsiId) == 0) {
            $data = new ProvinsiModel();
        } else {
            $data = ProvinsiModel::find($provinsiId);
            if (!$data) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Provinsi tidak ditemukan',
                ]);
            }
        }

        $data->nama = Str::upper($nama);
        $data->umum = Str::lower($umum);
        $data->iso = 'ID-' . Str::upper($iso);

        $data->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    public function aksiGetSearch($params)
    {
        $provinsiId = isset($params['provinsi_id'])
            ? $params['provinsi_id']
            : '';
        $data = ProvinsiModel::query()
            ->where('provinsi_id', 'like', '%' . $provinsiId . '%')
            ->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dengan nama ' . $data[0]->nama,
            'provinsi' => $data,
        ]);
    }
}
