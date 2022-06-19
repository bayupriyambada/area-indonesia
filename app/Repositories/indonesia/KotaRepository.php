<?php

namespace App\Repositories\indonesia;

use Illuminate\Support\Str;
use App\Helpers\ResponsesHelpers;
use App\Models\indonesia\KotaModel;

class KotaRepository
{
    public function aksiGetAll()
    {
        try {
            $data = KotaModel::query()
                ->with('kabupaten')
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
                return ResponsesHelpers::getResponseError(
                    500,
                    'nama tidak boleh kosong'
                );
            }
            $kabupatenId = isset($params['kabupaten_id'])
                ? $params['kabupaten_id']
                : '';

            if (strlen($kabupatenId) == 0) {
                return ResponsesHelpers::getResponseError(
                    500,
                    'kabupaten tidak boleh kosong'
                );
            }
            $kotaId = isset($params['kota_id']) ? $params['kota_id'] : '';
            if (strlen($kotaId) == 0) {
                $data = new KotaModel();
            } else {
                $data = KotaModel::find($kotaId);
                if (!$data) {
                    return ResponsesHelpers::getResponseError(
                        500,
                        'Kota tidak ditemukan'
                    );
                }
            }
            $data->nama = Str::ucfirst($nama);
            $data->slug = Str::slug($nama);
            $data->kabupaten_id = $kabupatenId;
            $data->save();

            return ResponsesHelpers::getResponseSucces(200, $data);
        } catch (\Exception $e) {
            return ResponsesHelpers::getResponseError(500, $e->getMessage());
        }
    }

    public function aksiGetSearch($params)
    {
        try {
            $data = KotaModel::query();
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
