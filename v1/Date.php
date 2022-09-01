<?php

final class Date {
    
    private const DAY_INT = [
        0 => "Hai",
        1 => "Ba",
        2 => "Tư",
        3 => "Năm",
        4 => "Sáu",
        5 => "Bảy",
        6 => "Chủ nhật"
    ];
    
    public static string $LOCALE_VN = "vi";
    
    public static function convertDatetoInt(string $date, string $LOCALE) {
        if($LOCALE === "vi" || $LOCALE === self::$LOCALE_VN) {
            if(in_array($date, self::DAY_INT)) {
                return (int) array_search($date, self::DAY_INT);
            }
            else {
                return -1;
            }
        }
    }
    
}
