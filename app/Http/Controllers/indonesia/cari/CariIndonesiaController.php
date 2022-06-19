<?php

namespace App\Http\Controllers\indonesia\cari;

use App\Http\Controllers\Controller;
use App\Repositories\indonesia\cari\CariIndonesiaRepository;
use Illuminate\Http\Request;

class CariIndonesiaController extends Controller
{
    public function CariKepulauan(Request $request)
    {
        $data = [
            'cari' => $request->input('cari'),
        ];
        $data = (new CariIndonesiaRepository())->aksiCariKepulauan($request);
        return $data;
    }
}
