<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PercentageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Percentage');
    }

    public function increase_calculator()
    {
        return Inertia::render('IncreaseCalculator');
    }


    public function decrease_calculator()
    {
        return Inertia::render('DecreaseCalculator');
    }


    public function change_calculator()
    {
        return Inertia::render('ChangeCalculator');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function operation(Request $request)
    {
        $percent = $request->inputPercent;
        $number = $request->inputNumber;

        $calculation = ($percent / 100) * $number;

        return response()->json([
            'result' => $calculation
        ]);
    }

    public function post_increase_calculator(Request $request)
    {
        $inputPercent = $request->inputPercent;
        $inputNumber = $request->inputNumber;
        $inputResult = $request->inputResult;
        $inputDiff = $request->inputDiff;


        $inputResult = (($inputPercent + 100)* $inputNumber) / 100;
        $inputDiff = $inputResult-$inputNumber;

        return response()->json([
            'inputResult' => $inputResult,
            'inputDiff' => $inputDiff
        ]);
    }

    public function post_decrease_calculator(Request $request)
    {
        $inputPercent = $request->inputPercent;
        $inputNumber = $request->inputNumber;


        $inputResult = ((100 - $inputPercent)* $inputNumber) / 100;
        $inputDiff = $inputResult-$inputNumber;

        return response()->json([
            'inputResult' => $inputResult,
            'inputDiff' => $inputDiff
        ]);
    }

    public function post_change_calculator(Request $request)
    {
        $inputPercent = $request->inputPercent;
        $inputNumber = $request->inputNumber;


        $inputResult = ($inputNumber-$inputPercent) / $inputPercent;
        $inputDiff = $inputNumber - $inputPercent;

        return response()->json([
            'inputResult' => $inputResult*100,
            'inputDiff' => $inputDiff
        ]);
    }
}
