<?php

namespace App\Service;

class DataNormalizationService
{
    public function normalizeCharacters($str, $logger): string
    {
        $out = '';

        for ($i = 0; $i < mb_strlen($str); ++$i) {
            $ch = mb_substr($str, $i, 1, 'UTF-8');

            /*
            $specialChars = array();
            if(strlen($ch) > mb_strlen($ch) && !in_array($ch, $specialChars)) {

                   array_push($specialChars, $ch);
                   $logger->info($ch);
                   print_r($specialChars);
            }
            */

            switch ($ch) {
                        case 'ß': $out .= 'ss';
                        break;
                        case 'ä': $out .= 'ae';
                        break;
                        case 'ü': $out .= 'ue';
                        break;
                        case 'ö': $out .= 'oe';
                        break;
                        case 'Ä': $out .= 'Ae';
                        break;
                        case 'Ü': $out .= 'Ue';
                        break;
                        case 'Ö': $out .= 'Oe';
                        break;
                        case '̈': $out .= 'e';
                        break;
                        default: $out .= $ch;
                   }
        }

        return $out;
    }

    public function normalizeLexical($str, $logger): string
    {
        //case insensitive
        $str = str_ireplace(['straße', ' straße', ' str.'], ['str.', 'str.', 'str.'], $str);

        return $str;
    }
}
