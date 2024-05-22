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

        if (!empty($request->locationName)) {
            $query->where('Field2', $request->locationName);
        }

        if (!empty($request->fromdate) && !empty($request->todate)) {
            $query->where(function($q) use ($request) {
                $q->whereBetween('EntryDate', [$request->fromdate, $request->todate])
                  ->orWhereDate('EntryDate', $request->fromdate)
                  ->orWhereDate('EntryDate', $request->todate);
            });
        }

        $totalGrossWeight = $query->sum('GrossWt');
        $totalTareWeight = $query->sum('TareWt');
        $totalNetWeight = $query->sum('NetWt');
        $results = $query->select('id','Party_Name','EntryDate', 'Vehicle_No', 'GrossWt', 'TareWt','NetWt', 'Field1', 'Field2')->orderBy('id', 'desc')->get();

        $vendorLists = WeightMachine::distinct()->pluck('Party_Name');
        $locationLists = WeightMachine::whereNotNull('Field2')->distinct()->pluck('Field2');
        return view('reports.vendorWiseCollection', compact('vendorLists', 'results', 'request', 'locationLists', 'totalGrossWeight', 'totalTareWeight', 'totalNetWeight'));
    }

    public function summaryReport(Request $request)
    {
        $query = WeightMachine::query();

        if (!empty($request->vendorName)) {
            $query->where('Party_Name', $request->vendorName);
        }

        if (!empty($request->fromdate) && !empty($request->todate)) {
            $query->where(function($q) use ($request) {
                $q->whereBetween('EntryDate', [$request->fromdate, $request->todate])
                  ->orWhereDate('EntryDate', $request->fromdate)
                  ->orWhereDate('EntryDate', $request->todate);
            });
        }

        $results = $query->selectRaw('Party_Name, SUM(GrossWt) as total_gross_weight, SUM(TareWt) as total_tare_weight, SUM(NetWt) as total_net_weight, COUNT(Party_Name) as total_vehicle_round')
                        ->groupBy('Party_Name')
                        ->get();

        $locationLists = WeightMachine::whereNotNull('Field2')->distinct()->pluck('Field2');
        $vendorLists = WeightMachine::distinct()->pluck('Party_Name');
        return view('reports.summaryReports', compact('results', 'request', 'locationLists', 'vendorLists'));
    }

    public function locationWiseReport(Request $request)
    {
        $query = WeightMachine::query();
        if (!empty($request->locationName)) {
            $query->where('Field2', $request->locationName);
        }

        if (!empty($request->fromdate) && !empty($request->todate)) {
            $query->where(function($q) use ($request) {
                $q->whereBetween('EntryDate', [$request->fromdate, $request->todate])
                  ->orWhereDate('EntryDate', $request->fromdate)
                  ->orWhereDate('EntryDate', $request->todate);
            });
        }

        $results = $query->select('id','Field2','Party_Name','EntryDate', 'Vehicle_No', 'GrossWt', 'TareWt','NetWt')->orderBy('id', 'desc')->get();

        $locationLists = WeightMachine::whereNotNull('Field2')->distinct()->pluck('Field2');
        return view('reports.locationWiseReport', compact('results', 'locationLists', 'request'));
    }

    public function vehicleTypeWiseReport(Request $request)
    {
        $query = WeightMachine::query();
        if (!empty($request->vehicleType)) {
            $query->where('Field1', $request->vehicleType);
        }

        if (!empty($request->fromdate) && !empty($request->todate)) {
            $query->where(function($q) use ($request) {
                $q->whereBetween('EntryDate', [$request->fromdate, $request->todate])
                  ->orWhereDate('EntryDate', $request->fromdate)
                  ->orWhereDate('EntryDate', $request->todate);
            });
        }

        $results = $query->select('id','Field1','Party_Name','EntryDate', 'Vehicle_No', 'GrossWt', 'TareWt','NetWt')->orderBy('id', 'desc')->get();

        $vehicleTypeLists = WeightMachine::whereNotNull('Field1')->distinct()->pluck('Field1');
        return view('reports.vehicleTypeWiseReport', compact('results', 'vehicleTypeLists', 'request'));
    }

    public function vehicleroundsreport(Request $request)
    {
        $query = WeightMachine::query();

        if (!empty($request->fromdate) && !empty($request->todate)) {
            $query->where(function($q) use ($request) {
                $q->whereBetween('EntryDate', [$request->fromdate, $request->todate])
                  ->orWhereDate('EntryDate', $request->fromdate)
                  ->orWhereDate('EntryDate', $request->todate);
            });
        }

        $results = $query->selectRaw('Vehicle_No, COUNT(Vehicle_No) as total_vehicle_round')
                        ->groupBy('Vehicle_No')
                        ->get();

        return view('reports.vehicleRoundsreport', compact('results', 'request'));
    }

    public function wardWisesummaryReport(Request $request)
    {
        $query = WeightMachine::query();

        if (!empty($request->locationName)) {
            $query->where('Field2', $request->locationName);
        }

        if (!empty($request->fromdate) && !empty($request->todate)) {
            $query->where(function($q) use ($request) {
                $q->whereBetween('EntryDate', [$request->fromdate, $request->todate])
                  ->orWhereDate('EntryDate', $request->fromdate)
                  ->orWhereDate('EntryDate', $request->todate);
            });
        }

        $results = $query->selectRaw('Field2, SUM(GrossWt) as total_gross_weight, SUM(TareWt) as total_tare_weight, SUM(NetWt) as total_net_weight, COUNT(Party_Name) as total_vehicle_round')
                        ->groupBy('Field2')
                        ->get();

        $locationLists = WeightMachine::whereNotNull('Field2')->distinct()->pluck('Field2');
        return view('reports.wardWiseSummaryReports', compact('results', 'request', 'locationLists'));
    }

    public function getImages($id)
    {
        $result = WeightMachine::findOrFail($id);
        $images = '';

        for ($i = 1; $i <= 8; $i++) {
            if ($result->{"Img$i"}) {
                $images .= '<img style="padding:5px;" src="data:image/png;base64,' . $result->{"Img$i"} . '" height="200" width="200" alt="Image ' . $i . '">';
            }
        }

        return $images;
    }

}
