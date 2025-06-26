<?php

namespace App\Http\Controllers;

use App\Models\Idea\standardData;
use App\Models\RS\RSMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class Dashboard extends Controller
{
    public function index()
    {
        return view('dashboard');
    }


    public function getChartData(Request $request)
    {
        $year = $request->input('year');

        // Inisialisasi array bulan
        $months = range(1, 12);

        $createdCounts = [];
        $approvedCounts = [];
        $rejectedCounts = [];

        foreach ($months as $month) {
            $created = RSMaster::whereYear('date', $year)
                ->whereMonth('date', $month)
                ->count();

            $approved = RSMaster::whereYear('date', $year)
                ->whereMonth('date', $month)
                ->where('status', 'approved')
                ->count();

            $rejected = RSMaster::whereYear('date', $year)
                ->whereMonth('date', $month)
                ->where('status', 'rejected')
                ->count();

            $createdCounts[] = $created;
            $approvedCounts[] = $approved;
            $rejectedCounts[] = $rejected;
        }

        return response()->json([
            'Created' => $createdCounts,
            'approved' => $approvedCounts,
            'rejected' => $rejectedCounts
        ]);
    }
    
    public function getStandardData()
    {
        $standardData = standardData::all();
        return response()->json($standardData);
    }
    

}
