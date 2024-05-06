<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\WeightMachine;

class DashboardController extends Controller
{

    public function index()
    {
        $vendors = WeightMachine::select('Party_Name')->distinct()->get();
        $today = Carbon::today();
        // Today's net collection sum
        $todayNetCollectionSum = WeightMachine::whereDate('created_at', $today)->sum('NetWt');
        $latestVehicle = WeightMachine::orderBy('id','desc')->take(5)->get();

        $todayCollectionDetails = WeightMachine::selectRaw('SUM(NetWt) as net_weight, SUM(GrossWt) as gross_weight, SUM(TareWt) as tare_weight')
        ->whereDate('created_at', $today)
        ->first();

        // vendorwise Detail Section Start
        $collectionDetails = [];

        foreach ($vendors as $vendor) {
            $collectionDetails[$vendor->Party_Name]['Today'] = WeightMachine::selectRaw('SUM(NetWt) as net_weight, SUM(GrossWt) as gross_weight, SUM(TareWt) as tare_weight, COUNT(tripID) as todays_round')
                ->whereDate('created_at', $today)
                ->where('Party_Name', $vendor->Party_Name)
                ->first();

            $collectionDetails[$vendor->Party_Name]['Current Month'] = WeightMachine::selectRaw('SUM(NetWt) as net_weight, SUM(GrossWt) as gross_weight, SUM(TareWt) as tare_weight, COUNT(tripID) as current_month_rounds')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->where('Party_Name', $vendor->Party_Name)
                ->first();

                $collectionDetails[$vendor->Party_Name]['Current Year'] = WeightMachine::selectRaw('SUM(NetWt) as net_weight, SUM(GrossWt) as gross_weight, SUM(TareWt) as tare_weight, COUNT(tripID) as current_month_rounds')
                ->whereYear('created_at', now()->year)
                ->where('Party_Name', $vendor->Party_Name)
                ->first();

                // Get the first day of the previous month
                $firstDayOfPreviousMonth = Carbon::today()->subMonth()->startOfMonth();

                // Get the last day of the previous month
                $lastDayOfPreviousMonth = Carbon::today()->subMonth()->endOfMonth();

                $collectionDetails[$vendor->Party_Name]['Previous Month'] = WeightMachine::selectRaw('SUM(NetWt) as net_weight, SUM(GrossWt) as gross_weight, SUM(TareWt) as tare_weight, COUNT(tripID) as current_month_rounds')
                ->whereBetween('created_at', [$firstDayOfPreviousMonth, $lastDayOfPreviousMonth])
                ->where('Party_Name', $vendor->Party_Name)
                ->first();

            // Repeat the same for previous month and current year
        }

        // vendorwise Detail Section End

        // Monthly net collection sum
        $monthlyNetCollectionSum = WeightMachine::whereYear('created_at', $today->year)
        ->whereMonth('created_at', $today->month)
        ->sum('NetWt');

        // Yearly net collection sum
        $yearlyNetCollectionSum = WeightMachine::whereYear('created_at', $today->year)->sum('NetWt');

        // Vendor count and Vehicle count
        $vendorAndVehicleCount = WeightMachine::selectRaw('COUNT(DISTINCT Party_Name) as vendor_count, COUNT(DISTINCT Vehicle_No) as vehicle_count')
        ->first();

        // Extract counts from the result
        $vendorCount = $vendorAndVehicleCount->vendor_count;
        $vehicleCount = $vendorAndVehicleCount->vehicle_count;

        return view('admin.dashboard',compact('vendors', 'todayNetCollectionSum', 'collectionDetails', 'latestVehicle', 'todayCollectionDetails', 'monthlyNetCollectionSum', 'yearlyNetCollectionSum', 'vendorAndVehicleCount', 'vendorCount', 'vehicleCount'));
    }

    public function getMonthlyCollectionData(Request $request)
    {
        $month = $request->has('month') ? $request->month : now()->month;
        $monthlyData = WeightMachine::selectRaw('Party_Name, SUM(NetWt) as total_weight')
                        ->whereMonth('created_at', $request->month)
                        ->groupBy('Party_Name')
                        ->get();

        return response()->json($monthlyData);
    }

    public function getDailyCollectionData()
    {
        $today = now();
        $startOfMonth = $today->startOfMonth();
        $endOfMonth = $today->endOfMonth();

        $vendors = WeightMachine::select('Party_Name')->distinct()->pluck('Party_Name');

        $monthlyData = [];
        foreach ($vendors as $vendor) {
            $vendorData = WeightMachine::selectRaw('DATE(created_at) as date, SUM(NetWt) as total_weight')
                        ->where('Party_Name', $vendor)
                        // ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                        ->groupBy('date')
                        ->orderBy('date')
                        ->get();
            $monthlyData[$vendor] = $vendorData;
        }

        return response()->json($monthlyData);
    }

    public function changeThemeMode()
    {
        $mode = request()->cookie('theme-mode');

        if($mode == 'dark')
            Cookie::queue('theme-mode', 'light', 43800);
        else
            Cookie::queue('theme-mode', 'dark', 43800);

        return true;
    }
}
