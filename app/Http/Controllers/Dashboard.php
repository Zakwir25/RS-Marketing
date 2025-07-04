<?php

namespace App\Http\Controllers;

use App\Models\Idea\standardData;
use Illuminate\Support\Facades\Auth;
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

     public function filter(Request $request)
    {
        $year = $request->input('year');
        $filter = $request->input('filter'); // 'weekly' atau 'monthly'
        
        if (!$year || !$filter) {
            return response()->json(['error' => 'Missing parameters'], 400);
        }

        // Ambil data dari tabel user
        $query = RSMaster::with('user', 'department')
            ->whereYear('created_at', $year);

        // Filter mingguan (ambil hanya data minggu ini dalam bulan yang sama)
        if($filter === 'weekly') {
            $query->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
          // Filter bulanan (ambil hanya data bulain ini dalam tahun ini)  
        } elseif ($filter === 'monthly') {
            $query->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ]);
        }

        
        $data = $query->limit(10)->get();
        
        return response()->json($data);
    }
    
    public function RsOverview()
    {
        $todayRequests = RSMaster::whereDate('created_at', Carbon::today())->count();
        $totalRequests = RSMaster::whereDate('created_at', $today)->count();

        return response ()->json([
            'todayRequests' => $todayRequests,
            'totalRequests' => $totalRequests
        ]);

    }
}
