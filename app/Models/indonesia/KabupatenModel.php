<?php

namespace App\Models\indonesia;

use Illuminate\Database\Eloquent\Model;

class KabupatenModel extends Model
{
    protected $table = 'kabupaten';
    protected $primaryKey = 'kabupaten_id';
    public $timestamps = false;

    public function provinsi()
    {
        return $this->belongsTo(
            'App\Models\indonesia\ProvinsiModel',
            'provinsi_id'
        );
    }

    public function kota()
    {
        return $this->belongsTo(
            'App\Models\indonesia\KotaModel',
            'kota_id',
            'kota_id'
        );
    }
}
