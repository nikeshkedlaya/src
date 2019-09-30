<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dateparser
 *
 * @author KaHO
 */
class Dateparser {

    //put your code here

    public function __construct() {
        
    }

    public static function convertDateObjFromStr(string $dateStr, string $dateFormatFrom = "Y/m/d") {
        return DateTime::createFromFormat($dateFormatFrom, $dateStr);
    }

    public static function convertDateFormat(string $dateStr, string $dateFormatFrom = "Y/m/d", string $dateFormatTo = "d/m/Y") {
        return self::convertDateObjFromStr($dateStr, $dateFormatFrom)->format($dateFormatTo);
    }

    public static function sortDateStringAsc(string $date1, string $date2, $dateFormat = "d/m/Y") {
        $a = self::convertDateObjFromStr($date1, $dateFormat);
        $b = self::convertDateObjFromStr($date2, $dateFormat);
        if ($a === $b) {
            return 0;
        } else if ($a < $b) {
            return -1;
        } else {
            return 1;
        }
    }

    public static function sortDateStringDesc(string $date1, string $date2, $dateFormat = "d/m/Y") {
        $a = self::convertDateObjFromStr($date1, $dateFormat);
        $b = self::convertDateObjFromStr($date2, $dateFormat);
        if ($a === $b) {
            return 0;
        } else if ($a < $b) {
            return 1;
        } else {
            return -1;
        }
    }

}
