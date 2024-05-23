<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class ExportController extends Controller
{
    public function generatePDF()
    {
        $results = [];
        $data = ['title' => 'Thane Municipal Corporation', 'date' => date('m/d/Y'), 'results' => $results];
        $pdf = PDF::loadView('reports.exports.report', $data)->setPaper('a4', 'landscape');

        return $pdf->stream('test.pdf');
    }
}
