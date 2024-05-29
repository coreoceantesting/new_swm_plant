<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\WeightMachine;
use Illuminate\Support\Facades\Storage;

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

    public function vehicleRoundsPDF(Request $request)
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

        $data = [
            'title' => 'Vehicle Rounds Report',
            'Name' => 'Vehicle Round',
            'reportdatetime' => \Carbon\Carbon::parse(now())->format('d-m-Y H:i:s A'),
            'fromdate' => \Carbon\Carbon::parse($request->fromdate)->format('d-m-Y'),
            'todate' => \Carbon\Carbon::parse($request->todate)->format('d-m-Y'),
            'results' => $results,
        ];
        $pdf = PDF::loadView('reports.exports.vehicleRoundsPdf', $data)->setPaper('a4', 'landscape');
        return $pdf->download('vehicleRoundsReport.pdf');
    }

    public function updateImages()
    {
        dd('hii');
        $details = WeightMachine::all();

        foreach ($details as $data) {
            // List of image fields
            $imageFields = ['Img1', 'Img2', 'Img3', 'Img4', 'Img5', 'Img6', 'Img7', 'Img8'];

            foreach ($imageFields as $field) {
                $base64Image = $data->$field;

                if ($base64Image) {
                    // Extract the base64 string and remove the prefix if exists
                    if (strpos($base64Image, 'base64,') !== false) {
                        $base64Image = explode('base64,', $base64Image)[1];
                    }

                    // Decode the base64 string
                    $imageData = base64_decode($base64Image);

                    // Generate a unique filename
                    $filename = uniqid() . '.png'; // Use the appropriate extension if not png

                    // Define the path to save the image
                    $filePath = 'images/' . $filename;

                    // Save the image to the public directory
                    Storage::disk('public')->put($filePath, $imageData);

                    // Update the record with the new file path
                    $data->$field = $filePath;
                }
            }

            $data->save();
        }

        return response()->json(['message' => 'Images updated successfully']);
    }

}
