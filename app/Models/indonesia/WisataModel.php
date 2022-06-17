<?php

namespace App\Models\indonesia;

use Illuminate\Database\Eloquent\Model;

class WisataModel extends Model
{
    protected $table = 'wisata';
    protected $primaryKey = 'wisata_id';
    public $timestamps = false;

    public function kabupaten()
    {
        return $this->belongsTo(
            'App\Models\indonesia\KabupatenModel',
            'kabupaten_id'
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
