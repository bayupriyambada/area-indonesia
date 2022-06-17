<?php

namespace App\Helpers;

class SearchHelpers
{
    public static function getSearch($params, $data)
    {
        $search = isset($params['search']) ? $params['search'] : '';
        $search = strtolower($search);
        $explode = explode('-', $search);
        return $data;
    }
}
