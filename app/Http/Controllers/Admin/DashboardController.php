<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\WeightMachine;

class DashboardController extends Controller
{

    public function index()
    {
        $today = Carbon::today();
        // Today's net collection sum
        $todayNetCollectionSum = WeightMachine::whereDate('created_at', $today)->sum('NetWt');
        $latestVehicle = WeightMachine::orderBy('id','desc')->take(5)->get();

        $todayCollectionDetails = WeightMachine::selectRaw('SUM(NetWt) as net_weight, SUM(GrossWt) as gross_weight, SUM(TareWt) as tare_weight')
        ->whereDate('created_at', $today)
        ->first();

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

        return view('admin.dashboard',compact('todayNetCollectionSum', 'latestVehicle', 'todayCollectionDetails', 'monthlyNetCollectionSum', 'yearlyNetCollectionSum', 'vendorAndVehicleCount', 'vendorCount', 'vehicleCount'));
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
