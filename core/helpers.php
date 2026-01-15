<?php

namespace Core;

class Helpers {
    public static function url($path = '') {
        return '/coachPro_v3' . $path;
    }

    public static function checkDateTerminer($dateSeance) {
        $currentDate = new \DateTime();
        $seanceDate = new \DateTime($dateSeance);
        return $seanceDate < $currentDate;
    }
}   