<?php

namespace Helper;

class Period
{
    public static function convert($period)
    {
        switch ($period) {
            case 1: return 'havi';
            case 3: return 'negyed éves';
            case 6: return 'fél éves';
            case 12: return 'éves';
        }
    }
}