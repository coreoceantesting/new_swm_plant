<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightMachine;

class ReportController extends Controller
{
    public function vendorWiseReport(Request $request)
    {
        $query = WeightMachine::query();

        if (!empty($request->vendorName)) {
            $query->where('Party_Name', $request->vendorName);
        }

        if (!empty($request->fromdate) && !empty($request->todate)) {
            $query->whereBetween('created_at', [$request->fromdate, $request->todate]);
        }

        $results = $query->orderBy('id', 'desc')->get();

        $vendorLists = WeightMachine::distinct()->pluck('Party_Name');
        return view('reports.vendorWiseCollection', compact('vendorLists', 'results', 'request'));
    }

    public function summaryReport(Request $request)
    {
        $query = WeightMachine::query();

        if (!empty($request->fromdate) && !empty($request->todate)) {
            $query->whereBetween('created_at', [$request->fromdate, $request->todate]);
        }

        $results = $query->selectRaw('Party_Name, SUM(GrossWt) as total_gross_weight, SUM(TareWt) as total_tare_weight, SUM(NetWt) as total_net_weight, COUNT(tripID) as total_vehicle_round')
                        ->groupBy('Party_Name')
                        ->get();
        
        return view('reports.summaryReports', compact('results', 'request'));
    }
}
