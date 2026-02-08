<?php
namespace App\Services;

class PercentageService
{
    public function calculateBasic(float $percent, float $number): float
    {
        return ($percent / 100) * $number;
    }

    public function calculateIncrease(float $percent, float $number): array
    {
        $result = (($percent + 100) * $number) / 100;
        return [
            'result' => $result,
            'diff' => $result - $number
        ];
    }

    public function calculateDecrease(float $percent, float $number): array
    {
        $result = ((100 - $percent) * $number) / 100;
        return [
            'result' => $result,
            'diff' => $result - $number
        ];
    }

    public function calculateChange(float $initial, float $final): array
    {
        return [
            'result' => (($final - $initial) / $initial) * 100,
            'diff' => $final - $initial
        ];
    }
}
