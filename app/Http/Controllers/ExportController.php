<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\WeightMachine;

class ExportController extends Controller
{
    public function generatePDF(Request $request)
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

        $data = [
            'title' => 'VendorWise Collection Report',
            'Name' => 'Vendor',
            'reportdatetime' => \Carbon\Carbon::parse(now())->format('d-m-Y H:i:s A'),
            'fromdate' => \Carbon\Carbon::parse($request->fromdate)->format('d-m-Y'),
            'todate' => \Carbon\Carbon::parse($request->todate)->format('d-m-Y'),
            'vendorName' => $request->vendorName,
            'results' => $results,
            'totalGrossWeight' => $totalGrossWeight,
            'totalTareWeight' => $totalTareWeight,
            'totalNetWeight' => $totalNetWeight
        ];
        $pdf = PDF::loadView('reports.exports.report', $data)->setPaper('a4', 'landscape');
        return $pdf->download('VendorWiseCollectionReport.pdf');
    }

    public function vehicleTypeWisePDF(Request $request)
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

        $totalGrossWeight = $query->sum('GrossWt');
        $totalTareWeight = $query->sum('TareWt');
        $totalNetWeight = $query->sum('NetWt');
        $results = $query->select('id','Field1', 'Field2','Party_Name','EntryDate', 'Vehicle_No', 'GrossWt', 'TareWt','NetWt')->orderBy('id', 'desc')->get();

        $data = [
            'title' => 'Vehicle TypeWise Report',
            'Name' => 'Vehicle Type',
            'reportdatetime' => \Carbon\Carbon::parse(now())->format('d-m-Y H:i:s A'),
            'fromdate' => \Carbon\Carbon::parse($request->fromdate)->format('d-m-Y'),
            'todate' => \Carbon\Carbon::parse($request->todate)->format('d-m-Y'),
            'vehicleType' => $request->vehicleType,
            'results' => $results,
            'totalGrossWeight' => $totalGrossWeight,
            'totalTareWeight' => $totalTareWeight,
            'totalNetWeight' => $totalNetWeight
        ];
        $pdf = PDF::loadView('reports.exports.vehicleTypeWisepdf', $data)->setPaper('a4', 'landscape');
        return $pdf->download('VehicleTypeWiseReport.pdf');
    }

    public function vendorWiseSummaryPDF(Request $request)
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

        $data = [
            'title' => 'Vendor Wise Summary Report',
            'Name' => 'Vendor',
            'reportdatetime' => \Carbon\Carbon::parse(now())->format('d-m-Y H:i:s A'),
            'fromdate' => \Carbon\Carbon::parse($request->fromdate)->format('d-m-Y'),
            'todate' => \Carbon\Carbon::parse($request->todate)->format('d-m-Y'),
            'vendorName' => $request->vendorName,
            'results' => $results,
        ];
        $pdf = PDF::loadView('reports.exports.vendorWiseSummaryPdf', $data)->setPaper('a4', 'landscape');
        return $pdf->download('VendorWiseSummaryReport.pdf');
    }

    public function wardWiseSummaryPDF(Request $request)
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

        $data = [
            'title' => 'Ward Wise Summary Report',
            'Name' => 'Ward',
            'reportdatetime' => \Carbon\Carbon::parse(now())->format('d-m-Y H:i:s A'),
            'fromdate' => \Carbon\Carbon::parse($request->fromdate)->format('d-m-Y'),
            'todate' => \Carbon\Carbon::parse($request->todate)->format('d-m-Y'),
            'locationName' => $request->locationName,
            'results' => $results,
        ];
        $pdf = PDF::loadView('reports.exports.wardWiseSummaryPdf', $data)->setPaper('a4', 'landscape');
        return $pdf->download('WardWiseSummaryReport.pdf');
    }

}
