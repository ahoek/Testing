<?php

namespace ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Util;

use TypeError;

class Slugify
{

    public static function slugify($string, $separator = '-', $maxLength = 96)
    {
        if (!is_string($string)) {
            throw new TypeError('Slugify can only slugify strings');
        }
        $title = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $title = preg_replace("%[^-/+|\w ]%", '', $title);
        $title = strtolower(trim(substr($title, 0, $maxLength), '-'));
        $title = preg_replace("/[\/_|+ -]+/", $separator, $title);

        return $title;
    }

}