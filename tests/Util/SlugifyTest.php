<?php

namespace Tests\ConnectHolland\UnitTestTutorial\AppBundle;

use PHPUnit_Framework_TestCase;
use ConnectHolland\UnitTestTutorial\AppBundle\Util\Slugify;

class SlugifyTest extends PHPUnit_Framework_TestCase
{

    public function providerTestSlugifyReturnsSlugifiedString()
    {
        return [
                ['dit is een string', 'dit-is-een-string'],
                ['dit is !@#$', 'dit-is-'],
        ];
    }

    /**
     * @dataProvider providerTestSlugifyReturnsSlugifiedString
     */
    public function testSlugifyReturnsSlugifiedString($originalString, $expectedResult)
    {
        var_dump('####',$originalString);
        $result = Slugify::slugify($originalString);

        $this->assertEquals($expectedResult, $result);
    }
}
