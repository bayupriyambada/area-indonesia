<?php

namespace App\Repositories\indonesia;

use Illuminate\Support\Str;
use App\Helpers\ResponsesHelpers;
use App\Models\indonesia\ProvinsiModel;
use App\Models\indonesia\KepulauanModel;

class ProvinsiRepository
{
    public function aksiGetAll()
    {
        try {
            $data = ProvinsiModel::query()
                ->with('kepulauan')
                ->get();
            return ResponsesHelpers::getResponseSucces(200, $data);
        } catch (\Exception $e) {
            return ResponsesHelpers::getResponseError(500, $e->getMessage());
        }
    }

    public function aksiGetPostData($params)
    {
        try {
            $nama = isset($params['nama']) ? $params['nama'] : '';

            if (strlen($nama) == 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'nama tidak boleh kosong',
                ]);
            }

            $kepulauanId = isset($params['kepulauan_id'])
                ? $params['kepulauan_id']
                : '';

            if (strlen($kepulauanId) == 0) {
                return ResponsesHelpers::getResponseError(
                    500,
                    'Kepulauan tidak boleh kosong'
                );
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
            $data->nama = Str::ucfirst($nama);
            $data->slug = Str::slug($nama);
            $data->kepulauan_id = $kepulauanId;

            $data->save();

            return ResponsesHelpers::getResponseSucces(200, $data);
        } catch (\Exception $e) {
            return ResponsesHelpers::getResponseError(500, $e->getMessage());
        }
    }

    public function aksiGetSearch($params)
    {
        try {
            $data = ProvinsiModel::query();
            $cari = isset($params['cari']) ? $params['cari'] : '';
            if (strlen($cari) > 0) {
                $data->where(function ($query) use ($cari) {
                    $query->whereRaw(
                        "lower(slug) LIKE '%" . strtolower($cari) . "%'"
                    );
                });
            }
            $data = $data->with('kepulauan')->get();
            return ResponsesHelpers::getResponseSucces(200, $data);
        } catch (\Exception $e) {
            return ResponsesHelpers::getResponseError(500, $e->getMessage());
        }
    }
}
