<?php

namespace App\Models\indonesia;

use Illuminate\Database\Eloquent\Model;

class KotaModel extends Model
{
    protected $table = 'kota';
    protected $primaryKey = 'kota_id';
    public $timestamps = false;

    public function kabupaten()
    {
        return $this->belongsTo(
            'App\Models\indonesia\KabupatenModel',
            'kabupaten_id'
        );
    }
}
