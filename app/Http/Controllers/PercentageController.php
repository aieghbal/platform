<?php

namespace App\Http\Controllers;
use App\Services\PercentageService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PercentageController extends Controller
{
    protected $percentageService;

    public function __construct(PercentageService $percentageService)
    {
        $this->percentageService = $percentageService;
    }

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
        $result = $this->percentageService->calculateBasic(
            $request->inputPercent,
            $request->inputNumber
        );

        return response()->json(['result' => $result]);
    }

    public function post_increase_calculator(Request $request)
    {
        $data = $this->percentageService->calculateIncrease(
            $request->inputPercent,
            $request->inputNumber
        );

        return response()->json([
            'inputResult' => $data['result'],
            'inputDiff' => $data['diff']
        ]);
    }

    public function post_decrease_calculator(Request $request)
    {
        $data = $this->percentageService->calculateDecrease(
            $request->inputPercent,
            $request->inputNumber
        );


        return response()->json([
            'inputResult' => $data['result'],
            'inputDiff' => $data['diff']
        ]);
    }

    public function post_change_calculator(Request $request)
    {
        $data = $this->percentageService->calculateChange(
            $request->inputPercent,
            $request->inputNumber
        );


        return response()->json([
            'inputResult' => $data['result'],
            'inputDiff' => $data['diff']
        ]);
    }
}
