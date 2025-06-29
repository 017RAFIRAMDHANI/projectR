<?php

namespace App\Http\Controllers;

use App\Models\Safeti;
use App\Models\Vendor;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;


class ReportController extends Controller
{
    //
    public function index(){
        return view('reports');
    }

    public function cetak(Request $request){
        $type = $request->type;
        $vendorVisitor = $request->vendorVisitor;

    if ($vendorVisitor == "Vendor") {

        $dataPermit = Safeti::with('vendor')
                            ->whereHas('vendor', function($query) {
                                $query->whereIn('status', ['Approved', 'Rejected']);
                            })
                            ->get();


        }else if($vendorVisitor == "Visitor"){
               $dataPermit = Safeti::with('visitor')
                            ->whereHas('visitor', function($query) {
                                $query->whereIn('status', ['Approved', 'Rejected']);
                            })
                            ->get();

        }

     //   dd($dataPermit);

        if($type == "PDF"){
             if ($vendorVisitor == "Vendor") {

        $pdf = FacadePdf::loadView('pdf.vendor-request-report', ['dataPermit' => $dataPermit]);
        return $pdf->download('data-permit.pdf');

             }else if($vendorVisitor == "Visitor"){

        $pdf = FacadePdf::loadView('pdf.visitor-request-report', ['dataPermit' => $dataPermit]);
        return $pdf->download('data-permit.pdf');

        }
        }

    }


}
