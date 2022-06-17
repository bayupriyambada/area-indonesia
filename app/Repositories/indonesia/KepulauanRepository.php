<?php

namespace App\Repositories\indonesia;

use Illuminate\Support\Str;
use App\Helpers\SearchHelpers;
use App\Helpers\ResponsesHelpers;
use App\Models\indonesia\KepulauanModel;

class KepulauanRepository
{
    public function aksiGetAll()
    {
        try {
            $data = KepulauanModel::query()->get();
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
                $data = new KepulauanModel();
            } else {
                $data = KepulauanModel::find($kepulauanId);
                if (!$data) {
                    return ResponsesHelpers::getResponseError(
                        500,
                        'Kepulauan tidak ditemukan'
                    );
                }
            }

            if ($data->nama == $nama) {
                return ResponsesHelpers::getResponseError(
                    500,
                    'Nama kepulauan sudah ada'
                );
            } else {
                $data->nama = Str::ucfirst($nama);
            }

            $data->save();

            return ResponsesHelpers::getResponseSucces(200, $data);
        } catch (\Exception $e) {
            return ResponsesHelpers::getResponseError(500, $e->getMessage());
        }
    }

    public function aksiGetSearch($params)
    {
        try {
            // if (isset($params['search'])) {
            //     $data = SearchHelpers::getSearch($data, $params['search']);
            // }
            $data = KepulauanModel::query();
            // dd($data);

            $cari = isset($params['cari']) ? $params['cari'] : '';
            if (strlen($cari) > 0) {
                $data->where(function ($query) use ($cari) {
                    $query->whereRaw(
                        "lower(nama) LIKE '%" . strtolower($cari) . "%'"
                    );
                });
            }
            $data = $data->get();
            // dd($data);
            return ResponsesHelpers::getResponseSucces(200, $data);
        } catch (\Exception $e) {
            return ResponsesHelpers::getResponseError(500, $e->getMessage());
        }
    }
}
