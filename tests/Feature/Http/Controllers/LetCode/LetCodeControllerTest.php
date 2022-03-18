<?php

namespace Http\Controllers\LetCode;

use App\Http\Controllers\LetCode\LetCodeController;

class LetCodeControllerTest extends \PHPUnit\Framework\TestCase
{

    public function testArray646()
    {
        $letCode = new LetCodeController();
        $nums = [1, 2, 3, 4, 5, 6, 7];
        $correct = [5, 6, 7, 1, 2, 3, 4];
        $k = 3;
        $result = $letCode->array646($nums, $k);
        $this->assertEquals($correct, $result);
    }

    public function testarray578()
    {
        $letCode = new LetCodeController();
        $nums = [2, 14, 18, 22, 22];
        $result = $letCode->array578($nums);
        $this->assertEquals(true, $result);
    }

    public function testString887()
    {
        $letCode = new LetCodeController();
        $str = ["dog", "racecar", "car"];
        $expect = "";
        $str = ["flower", "flow", "flight"];
        $expect = "fl";
        $result = $letCode->string887($str);
        $this->assertEquals($expect, $result);
    }


    public function testDynamicProgramming572()
    {
        $letCode = new LetCodeController();
        $prices = [3, 2, 6, 5, 0, 3];
        $expect = 4;
        $result = $letCode->dynamicProgramming572($prices);
        $this->assertEquals($expect, $result);
    }
}
