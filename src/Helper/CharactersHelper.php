<?php

declare(strict_types=1);

namespace App\Helper;

class CharactersHelper
{
    public function getCharacters($page, $type): array
    {
        $url = 'https://rickandmortyapi.com/api/character/?page=' . strval($page);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $rawResponse = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        if ($info['http_code'] !== 200) {
            return [];
        }

        $response = json_decode($rawResponse, true);

        return $response[$type];
    }
}
