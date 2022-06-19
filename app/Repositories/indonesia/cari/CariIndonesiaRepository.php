<?php

namespace App\Repositories\indonesia\cari;

use App\Helpers\ResponsesHelpers;
use App\Models\indonesia\KepulauanModel;

class CariIndonesiaRepository
{
    public function aksiCariKepulauan($params)
    {
        try {
            $data = KepulauanModel::query();
            $cari = isset($params['cari']) ? $params['cari'] : '';
            if (strlen($cari) > 0) {
                $data->where(function ($query) use ($cari) {
                    $query->whereRaw(
                        "lower(slug) LIKE '%" . strtolower($cari) . "%'"
                    );
                });
            }
            $data = $data->get();
            return ResponsesHelpers::getResponseSucces(200, $data);
        } catch (\Exception $e) {
            return ResponsesHelpers::getResponseError(500, $e->getMessage());
        }
    }
}
