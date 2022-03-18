<?php

namespace App\Http\Controllers\LetCode;

use App\Http\Controllers\Controller;

class LetCodeController extends Controller
{
    public function array646($nums1, $k1)
    {
        return $this->rotate($nums1, $k1);
    }

    function rotate(&$nums, $k)
    {
        $count = count($nums);
        $k %= $count;
        $a2 = array_splice($nums, 0, $count - $k);
        $a1 = array_splice($nums, count($nums) - $k, $k);
        $nums = array_merge($a1, $a2);
        return $nums;
    }

    public function array578($nums)
    {
        return $this->containsDuplicate($nums);
    }

    public function containsDuplicate($nums)
    {
        foreach ($nums as $i => $iValue) {
            $nums1 = $nums;
            if (in_array($iValue, array_splice($nums1, $i + 1, count($nums) - $i), true)) {
                return true;
            }
        }
        return false;
    }

    public function dynamicProgramming572($prices)
    {
        return $this->maxProfit($prices);
    }

    public function maxProfit($prices): int
    {
        $maxValue = 0;
        $minPrice = 100000;
        foreach ($prices as $iValue) {
            if ($minPrice > $iValue) {
                $minPrice = $iValue;
            }
            $diff = $iValue - $minPrice;
            if ($diff > $maxValue) {
                $maxValue = $diff;
            }
        }

        return $maxValue;
    }

    public function string887($strs)
    {
        return $this->longestCommonPrefix($strs);
    }

    public function longestCommonPrefix($strs)
    {
        $size = count($strs);
        $prefix = $strs[0];
        for ($i = 1; $i < $size; $i++) {
            $c = strpos($prefix, $strs[$i]);
            //dump($c, $prefix);
            if ($c !== 0) {
                return '';
            }
            while ($c > -1) {
                $prefix = substr($prefix, 0, -1);
                if (empty($prefix)) {
                    return "";
                }
            }

        }

        return substr($prefix, 0, -1);
    }
}
