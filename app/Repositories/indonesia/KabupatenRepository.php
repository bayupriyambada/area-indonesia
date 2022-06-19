<?php

namespace App\Repositories\indonesia;

use Illuminate\Support\Str;
use App\Helpers\ResponsesHelpers;
use App\Models\indonesia\KabupatenModel;

class KabupatenRepository
{
    public function aksiGetAll()
    {
        try {
            $data = KabupatenModel::query()
                ->with('provinsi')
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

            $provinsiId = isset($params['provinsi_id'])
                ? $params['provinsi_id']
                : '';
            if (!$provinsiId) {
                return ResponsesHelpers::getResponseError(
                    500,
                    'Provinsi tidak ditemukan'
                );
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

            return ResponsesHelpers::getResponseSucces(200, $data);
        } catch (\Exception $e) {
            return ResponsesHelpers::getResponseError(500, $e->getMessage());
        }
    }

    public function aksiGetSearch($params)
    {
        try {
            $data = KabupatenModel::query();
            $cari = isset($params['cari']) ? $params['cari'] : '';
            if (strlen($cari) > 0) {
                $data->where(function ($query) use ($cari) {
                    $query->whereRaw(
                        "lower(slug) LIKE '%" . strtolower($cari) . "%'"
                    );
                });
            }
            $data = $data->with('provinsi')->get();
            return ResponsesHelpers::getResponseSucces(200, $data);
        } catch (\Exception $e) {
            return ResponsesHelpers::getResponseError(500, $e->getMessage());
        }
    }
}
