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
            'reportdatetime' => date('Y-m-d H:i:s A'),
            'fromdate' => $request->fromdate,
            'todate' => $request->todate,
            'vendorName' => $request->vendorName,
            'results' => $results,
            'totalGrossWeight' => $totalGrossWeight,
            'totalTareWeight' => $totalTareWeight,
            'totalNetWeight' => $totalNetWeight
        ];
        $pdf = PDF::loadView('reports.exports.report', $data)->setPaper('a4', 'landscape');
        return $pdf->download('VendorWiseCollectionReport.pdf');
    }
}
