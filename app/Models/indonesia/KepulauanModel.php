<?php

namespace App\Models\indonesia;

use Illuminate\Database\Eloquent\Model;

class KepulauanModel extends Model
{
    protected $table = 'kepulauan';
    protected $primaryKey = 'kepulauan_id';
    public $timestamps = false;

    public function provinsi()
    {
        return $this->hasMany(
            'App\Models\indonesia\ProvinsiModel',
            'kepulauan_id'
        );
    }
}
