<?php

namespace App\Http\Controllers;

use App\Exports\VendorExport;
use App\Exports\VisitorExport;
use App\Models\Repot;
use App\Models\Safeti;
use App\Models\Vendor;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    //

    
    public function index(){
        $dataRepot = Repot::orderby('created_at','desc')->get();

        return view('reports',[
            "dataRepot" => $dataRepot
        ]);
    }

    public function delete($id_repot)
{
    // Find the report by id
    $report = Repot::findOrFail($id_repot); // Throws 404 if not found

    // Get the file path from the name_file_pdf field in the database
    $filePath = storage_path('app/public/' . $report->name_file_pdf);

    // Check if the file exists and delete it
    if (file_exists($filePath)) {
        unlink($filePath); // Delete the file from the storage
    }

    // Delete the record from the database
    $report->delete();

    // Return a response (success or failure)
    return back()->with('success', 'Report deleted successfully');
}

   public function download(Request $request, $id_repot)
{
    // Retrieve the report record from the database by the id_repot
    $report = Repot::findOrFail($id_repot); // This will throw a 404 if the report is not found

    // Get the full file path
    $filePath = storage_path('app/public/' . $report->name_file_pdf);

    // Check if the file exists
    if (file_exists($filePath)) {
        // Return the file as a download response
        return response()->download($filePath);
    } else {
        // If the file does not exist, return an error message
        return response()->json(['error' => 'File not found'], 404);
    }
}

  public function shedule(Request $request)
{
    $type = $request->type;
    $schedule = $request->schedule;
    $today = Carbon::today();

    // Handling Vendor Reports
    if ($type == "Vendor") {

        // Daily Report
        if ($schedule == "Daily") {
            $startDate = $today; // Today
            $endDate = $today; // Today

            $dataPermit = Safeti::with('vendor')
                                ->whereHas('vendor', function ($query) {
                                    $query->whereIn('status', ['Approved', 'Rejected']);
                                })
                                // Use whereDate to ignore the time part
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get();
        }
        // Weekly Report
        else if ($schedule == "Weekly") {
            $startDate = $today->copy()->subDays(7); // 7 days ago from today
            $endDate = $today; // Today

            $dataPermit = Safeti::with('vendor')
                                ->whereHas('vendor', function ($query) {
                                    $query->whereIn('status', ['Approved', 'Rejected']);
                                })
                                // Use whereDate to ignore the time part
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get();
        }
        // Monthly Report
        else if ($schedule == "Monthly") {
            $startDate = $today->copy()->subDays(30); // 30 days ago from today
            $endDate = $today; // Today

            $dataPermit = Safeti::with('vendor')
                                ->whereHas('vendor', function ($query) {
                                    $query->whereIn('status', ['Approved', 'Rejected']);
                                })
                                // Use whereDate to ignore the time part
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get();
        }

        // Generate PDF for Vendor
       $uniqueNumber = rand(100000, 999999); // Generates a random 6-digit number, you can modify this logic

    // Generate the PDF content using data
    $pdf = FacadePdf::loadView('pdf.vendor-request-report', ['dataPermit' => $dataPermit]);

    // Define the directory path where the PDF will be stored
    $directoryPath = storage_path('app/public/report');

    // Check if the directory exists, if not, create it
    if (!file_exists($directoryPath)) {
        mkdir($directoryPath, 0755, true); // Create directory with the appropriate permissions
    }

    // Define the file path with the unique number
    $filePath = storage_path('app/public/report/vendor-permit-' . $uniqueNumber . '.pdf');

    // Save the PDF to the specified path
    $pdf->save($filePath);

    // Save the file information to the database
    Repot::create([
        "id_akun" => Auth::user()->id ?? '',
        "name_akun_download" => Auth::user()->name ?? '',
        "type" => $request->type ?? '',
        "name" => $request->reportName ?? '',
        "schedule" => $request->schedule ?? '',
        "name_file_pdf" => 'report/vendor-permit-' . $uniqueNumber . '.pdf',  // Store the relative path in the DB
    ]);

    return back()->with('success','Create shedule report permit success');

    } else if ($type == "Visitor") {

        // Daily Report for Visitor
        if ($schedule == "Daily") {
            $startDate = $today; // Today
            $endDate = $today; // Today

            $dataPermit = Safeti::with('visitor')
                                ->whereHas('visitor', function ($query) {
                                    $query->whereIn('status', ['Approved', 'Rejected']);
                                })
                                // Use whereDate to ignore the time part
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get();
        }
        // Weekly Report for Visitor
        else if ($schedule == "Weekly") {
            $startDate = $today->copy()->subDays(7); // 7 days ago from today
            $endDate = $today; // Today

            $dataPermit = Safeti::with('visitor')
                                ->whereHas('visitor', function ($query) {
                                    $query->whereIn('status', ['Approved', 'Rejected']);
                                })
                                // Use whereDate to ignore the time part
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get();
        }
        // Monthly Report for Visitor
        else if ($schedule == "Monthly") {
            $startDate = $today->copy()->subDays(30); // 30 days ago from today
            $endDate = $today; // Today

            $dataPermit = Safeti::with('visitor')
                                ->whereHas('visitor', function ($query) {
                                    $query->whereIn('status', ['Approved', 'Rejected']);
                                })
                                // Use whereDate to ignore the time part
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get();
        }

        $uniqueNumber = rand(100000, 999999); // Generates a random 6-digit number, you can modify this logic

    // Generate the PDF content using data
    $pdf = FacadePdf::loadView('pdf.visitor-request-report', ['dataPermit' => $dataPermit]);

    // Define the directory path where the PDF will be stored
    $directoryPath = storage_path('app/public/report');

    // Check if the directory exists, if not, create it
    if (!file_exists($directoryPath)) {
        mkdir($directoryPath, 0755, true); // Create directory with the appropriate permissions
    }

    // Define the file path with the unique number
    $filePath = storage_path('app/public/report/visitor-permit-' . $uniqueNumber . '.pdf');

    // Save the PDF to the specified path
    $pdf->save($filePath);

    // Save the file information to the database
    Repot::create([
        "id_akun" => Auth::user()->id ?? '',
        "name_akun_download" => Auth::user()->name ?? '',
        "type" => $request->type ?? '',
        "name" => $request->reportName ?? '',
        "schedule" => $request->schedule ?? '',
        "name_file_pdf" => 'report/visitor-permit-' . $uniqueNumber . '.pdf',  // Store the relative path in the DB
    ]);

    return back()->with('success','Create shedule report permit success');
    }
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
