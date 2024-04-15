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

        $results = $query->select('Party_Name','EntryDate', 'Vehicle_No', 'GrossWt', 'TareWt','NetWt', 'Img1','Img2','Img3','Img4','Img5','Img6','Img7','Img8')->orderBy('id', 'desc')->get();

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

    public function locationWiseReport(Request $request)
    {   
        $query = WeightMachine::query();
        if (!empty($request->locationName)) {
            $query->where('Field2', $request->locationName);
        }

        if (!empty($request->fromdate) && !empty($request->todate)) {
            $query->whereBetween('created_at', [$request->fromdate, $request->todate]);
        }

        $results = $query->orderBy('id', 'desc')->get();

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
            $query->whereBetween('created_at', [$request->fromdate, $request->todate]);
        }

        $results = $query->orderBy('id', 'desc')->get();

        $vehicleTypeLists = WeightMachine::whereNotNull('Field1')->distinct()->pluck('Field1');
        return view('reports.vehicleTypeWiseReport', compact('results', 'vehicleTypeLists', 'request'));
    }

    public function loadImages(Request $request)
    {
        $perPage = 4; // Number of images per page
        $totalImages = 8; // Total number of images
        $totalPages = ceil($totalImages / $perPage); // Calculate total pages
        $currentPage = $request->page ?? 1; // Get current page from request parameter
        $start = ($currentPage - 1) * $perPage; // Calculate starting index
        $end = min($start + $perPage, $totalImages); // Calculate ending index
        
        $images = '';
        for ($i = $start + 1; $i <= $end; $i++) {
            if ($result->{"Img$i"}) {
                $images .= '<img src="data:image/png;base64,'. $result->{"Img$i"} .'" height="200" width="200" alt="Image '. $i .'">';
            }
        }

        $pagination = '';
        for ($page = 1; $page <= $totalPages; $page++) {
            $pagination .= '<li class="page-item '. ($page == $currentPage ? 'active' : '') .'">';
            $pagination .= '<a class="page-link" href="?page='. $page .'">'. $page .'</a>';
            $pagination .= '</li>';
        }

        return response()->json(['images' => $images, 'pagination' => $pagination]);
    }
}
