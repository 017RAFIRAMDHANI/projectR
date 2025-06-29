<?php

namespace App\Http\Controllers;

use App\Exports\VendorExport;
use App\Exports\VisitorExport;
use App\Models\Safeti;
use App\Models\Vendor;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    //
    public function index(){
        return view('reports');
    }

    public function cetak(Request $request){
        $type = $request->type;
        $vendorVisitor = $request->vendorVisitor;
        $waktu = $request->waktu;
 // dd($request->all());
      $today = Carbon::today();

     if ($vendorVisitor == "Vendor") {

        if ($waktu == "seminggu") {
            // Clone today's date for start date and subtract 7 days
            $startDate = $today->copy()->subDays(7);  // 7 days ago from today
            $endDate = $today;  // Today

            // Log the query for debugging purposes
           // Log::info('Start Date: '.$startDate);
           // Log::info('End Date: '.$endDate);

            $dataPermit = Safeti::with('vendor')
                                ->whereHas('vendor', function($query) {
                                    $query->whereIn('status', ['Approved', 'Rejected']);
                                })
                                // Use whereDate to ignore the time part
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get();

        } else if ($waktu == "sebulan") {
            // Filter data from the last 30 days, including today
            $startDate = $today->copy()->subDays(30);  // 30 days ago from today
            $endDate = $today;  // Today

            $dataPermit = Safeti::with('vendor')
                                ->whereHas('vendor', function($query) {
                                    $query->whereIn('status', ['Approved', 'Rejected']);
                                })
                                // Use whereDate to ignore the time part
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get();

        } else if ($waktu == "tigabulan") {
            // Filter data from the last 3 months, including today
            $startDate = $today->copy()->subMonths(3)->startOfMonth();  // Start of three months ago (first day of that month)
            $endDate = $today;  // Today
            //Log::info('Start Date: '.$startDate);
            //Log::info('End Date: '.$endDate);
            $dataPermit = Safeti::with('vendor')
                                ->whereHas('vendor', function($query) {
                                    $query->whereIn('status', ['Approved', 'Rejected']);
                                })
                                // Use whereDate to ignore the time part
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get();

        } else {
            // Default query with no time filter
            $dataPermit = Safeti::with('vendor')
                                ->whereHas('vendor', function($query) {
                                    $query->whereIn('status', ['Approved', 'Rejected']);
                                })
                                ->get();
        }

    } else if ($vendorVisitor == "Visitor") {

        if ($waktu == "seminggu") {
            // Clone today's date for start date and subtract 7 days
            $startDate = $today->copy()->subDays(7);
            $endDate = $today;

            $dataPermit = Safeti::with('visitor')
                                ->whereHas('visitor', function($query) {
                                    $query->whereIn('status', ['Approved', 'Rejected']);
                                })
                                // Use whereDate to ignore the time part
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get();

        } else if ($waktu == "sebulan") {
            // Filter data for the last 30 days, including today
            $startDate = $today->copy()->subDays(30);
            $endDate = $today;

            $dataPermit = Safeti::with('visitor')
                                ->whereHas('visitor', function($query) {
                                    $query->whereIn('status', ['Approved', 'Rejected']);
                                })
                                // Use whereDate to ignore the time part
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get();

        } else if ($waktu == "tigabulan") {
            // Filter data for the last 3 months, including today
            $startDate = $today->copy()->subMonths(3)->startOfMonth();
            $endDate = $today->endOfMonth();  // End of the current month

            $dataPermit = Safeti::with('visitor')
                                ->whereHas('visitor', function($query) {
                                    $query->whereIn('status', ['Approved', 'Rejected']);
                                })
                                // Use whereDate to ignore the time part
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get();

        } else {
            // Default query with no time filter for visitors
            $dataPermit = Safeti::with('visitor')
                                ->whereHas('visitor', function($query) {
                                    $query->whereIn('status', ['Approved', 'Rejected']);
                                })
                                ->get();
        }

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

        else  if ($type == "Excel") {
        if ($vendorVisitor == "Vendor") {
            if ($waktu == "seminggu") {
                // Filter data from the last 7 days, including today
                $startDate = $today->copy()->subDays(7);  // 7 days ago from today
                $endDate = $today;  // Today

                $dataPermit = Safeti::with('vendor')
                                    ->whereHas('vendor', function($query) {
                                        $query->whereIn('status', ['Approved', 'Rejected']);
                                    })
                                    // Use whereDate to ignore the time part
                                    ->whereDate('created_at', '>=', $startDate)
                                    ->whereDate('created_at', '<=', $endDate)
                                    ->get();

            } else if ($waktu == "sebulan") {
                // Filter data from the last 30 days, including today
                $startDate = $today->copy()->subDays(30);  // 30 days ago from today
                $endDate = $today;  // Today

                $dataPermit = Safeti::with('vendor')
                                    ->whereHas('vendor', function($query) {
                                        $query->whereIn('status', ['Approved', 'Rejected']);
                                    })
                                    // Use whereDate to ignore the time part
                                    ->whereDate('created_at', '>=', $startDate)
                                    ->whereDate('created_at', '<=', $endDate)
                                    ->get();

            } else if ($waktu == "tigabulan") {
                // Filter data from the last 3 months, including today
                $startDate = $today->copy()->subMonths(3)->startOfMonth();  // Start of three months ago (first day of that month)
                $endDate = $today;  // Today

                $dataPermit = Safeti::with('vendor')
                                    ->whereHas('vendor', function($query) {
                                        $query->whereIn('status', ['Approved', 'Rejected']);
                                    })
                                    // Use whereDate to ignore the time part
                                    ->whereDate('created_at', '>=', $startDate)
                                    ->whereDate('created_at', '<=', $endDate)
                                    ->get();

            } else {
                // Default query with no time filter
                $dataPermit = Safeti::with('vendor')
                                    ->whereHas('vendor', function($query) {
                                        $query->whereIn('status', ['Approved', 'Rejected']);
                                    })
                                    ->get();
            }

            // Return Excel download
            return Excel::download(new VendorExport($dataPermit), 'vendor_data.xlsx');

        } else if ($vendorVisitor == "Visitor") {
            if ($waktu == "seminggu") {
                // Filter data for the last 7 days, including today
                $startDate = $today->copy()->subDays(7);
                $endDate = $today;

                $dataPermit = Safeti::with('visitor')
                                    ->whereHas('visitor', function($query) {
                                        $query->whereIn('status', ['Approved', 'Rejected']);
                                    })
                                    // Use whereDate to ignore the time part
                                    ->whereDate('created_at', '>=', $startDate)
                                    ->whereDate('created_at', '<=', $endDate)
                                    ->get();

            } else if ($waktu == "sebulan") {
                // Filter data for the last 30 days, including today
                $startDate = $today->copy()->subDays(30);
                $endDate = $today;

                $dataPermit = Safeti::with('visitor')
                                    ->whereHas('visitor', function($query) {
                                        $query->whereIn('status', ['Approved', 'Rejected']);
                                    })
                                    // Use whereDate to ignore the time part
                                    ->whereDate('created_at', '>=', $startDate)
                                    ->whereDate('created_at', '<=', $endDate)
                                    ->get();

            } else if ($waktu == "tigabulan") {
                // Filter data for the last 3 months, including today
                $startDate = $today->copy()->subMonths(3)->startOfMonth();
                $endDate = $today->endOfMonth();  // End of the current month

                $dataPermit = Safeti::with('visitor')
                                    ->whereHas('visitor', function($query) {
                                        $query->whereIn('status', ['Approved', 'Rejected']);
                                    })
                                    // Use whereDate to ignore the time part
                                    ->whereDate('created_at', '>=', $startDate)
                                    ->whereDate('created_at', '<=', $endDate)
                                    ->get();

            } else {
                // Default query with no time filter for visitors
                $dataPermit = Safeti::with('visitor')
                                    ->whereHas('visitor', function($query) {
                                        $query->whereIn('status', ['Approved', 'Rejected']);
                                    })
                                    ->get();
            }

            // Return Excel download
            return Excel::download(new VisitorExport($dataPermit), 'visitor_data.xlsx');
        }
    }

}

}
