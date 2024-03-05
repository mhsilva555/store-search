<?php

namespace App\StoreSearch\Helpers;

class Cities
{
    public static function getData($city)
    {
        $json = STORE_SEARCH_PLUGIN_PATH . '/storage/json/cidades.json';

        if (!file_exists($json)) {
            return false;
        }

        $content = file_get_contents($json);
        $cidades = (object) json_decode($content);

        foreach ($cidades->CIDADES as $cidade) {
            foreach ($cidade as $info) {
                if ($info->NOME == strtoupper($city)) {
                    return $info;
                }
            }
        }

        return false;
    }
}