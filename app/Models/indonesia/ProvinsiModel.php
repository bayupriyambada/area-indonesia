<?php

namespace App\Models\indonesia;

use Illuminate\Database\Eloquent\Model;

class ProvinsiModel extends Model
{
    protected $table = 'provinsi';
    protected $primaryKey = 'provinsi_id';
    public $timestamps = false;

    public function kabupaten()
    {
        return $this->hasMany(
            'App\Models\indonesia\KabupatenModel',
            'provinsi_id'
        );
    }

    public function kota()
    {
        return $this->hasMany(
            'App\Models\indonesia\KotaModel',
            'provinsi_id',
            'kota_id'
        );
    }

    public function kepulauan()
    {
        return $this->belongsTo(
            'App\Models\indonesia\KepulauanModel',
            'kepulauan_id'
        );
    }
}
