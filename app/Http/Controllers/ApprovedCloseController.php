<?php

namespace App\Http\Controllers;

use App\Models\Approved;
use App\Models\Histori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovedCloseController extends Controller
{
           public function __construct()
    {
        $this->middleware('auth');


    }
public function index(Request $request)
{
    if (Auth::user()->access_visvin_view !== 1) {

        return back()->with('error','contact DHI for further access');
    }

    // Get the search query input from the request
    $searchVisitor = $request->input('search_visitor');
    $searchVendor = $request->input('search_vendor');
    $visitorStatusFilter = $request->input('visitorStatusFilter');
    $vendorStatusFilter = $request->input('vendorStatusFilter');

        $openCount = Approved::where('status', 'Open')->count();
    $closedCount = Approved::where('status', 'Closed')->count();
    $expiredCount = Approved::where('status', 'Expired')->count();
    $totalCount = Approved::count(); // Count all permits

    // Get today's date
    $currentDate = Carbon::today();

    // Ambil page untuk masing-masing tab
    $visitorPage = $request->get('visitor_page', 1);
    $vendorPage = $request->get('vendor_page', 1);

    // Start the query for fetching the data from 'Approved' table
    $dataVisitor = Approved::with('visitor')->where('type','Visitor'); // Start with visitor relationship
    $dataVendor = Approved::with('vendor')->where('type','Vendor'); // Start with vendor relationship

    // If there's a search term for Visitor, apply it to filter the results
    if ($searchVisitor) {
        $dataVisitor = $dataVisitor->whereHas('visitor', function($query) use ($searchVisitor) {
            $query->where('permit_number', 'like', '%' . $searchVisitor . '%')
                ->orWhere('pic_name', 'like', '%' . $searchVisitor . '%')
                ->orWhere('purpose_visit', 'like', '%' . $searchVisitor . '%')
                ->orWhere('request_date_to', 'like', '%' . $searchVisitor . '%')
                ->orWhere('status', 'like', '%' . $searchVisitor . '%');
        });
    }
   if ($visitorStatusFilter) {
        $dataVisitor = $dataVisitor->where('status', 'like', '%' . $visitorStatusFilter . '%');
    }


    // Fetch the filtered visitor data
$dataVisitor = $dataVisitor->orderBy('created_at', 'desc')->paginate(5, ['*'], 'visitor_page', $visitorPage);


    // If there's a search term for Vendor, apply it to filter the results
    if ($searchVendor) {
        $dataVendor = $dataVendor->whereHas('vendor', function($query) use ($searchVendor) {
            $query->where('permit_number', 'like', '%' . $searchVendor . '%')
                ->orWhere('company_name', 'like', '%' . $searchVendor . '%')
                ->orWhere('requestor_name', 'like', '%' . $searchVendor . '%')
                ->orWhere('work_description', 'like', '%' . $searchVendor . '%')
                ->orWhere('validity_date_to', 'like', '%' . $searchVendor . '%')
                ->orWhere('status', 'like', '%' . $searchVendor . '%');
        });
    }
   if ($vendorStatusFilter) {
        $dataVendor = $dataVendor->where('status', 'like', '%' . $vendorStatusFilter . '%');
    }
    // Fetch the filtered vendor data
    $dataVendor = $dataVendor->orderBy('created_at', 'desc')->paginate(20, ['*'], 'vendor_page', $vendorPage);

    $Close = Approved::all();

    // Check for dates and update the status if necessary
    foreach ($Close as $approved) {
        $statusUpdated = false; // Menandakan apakah status diperbarui

        // Check untuk Visitor
        if (!empty($approved->visitor->request_date_to)) {
            $requestDateTo = Carbon::parse($approved->visitor->request_date_to);
            if ($requestDateTo->isBefore(now()->toDateString())) {
                if ($approved->status !== 'Expired') {  // Hanya update jika status belum 'Expired'
                    $approved->status = 'Expired';
                    $approved->save();

                    $approved->visitor->status_aktif = 'Inactive';
                    $approved->visitor->save();

                    // Cek apakah histori sudah ada
                    $exists = Histori::where('id_data', $approved->visitor->id_visitor)
                                     ->where('type', 'Visitor')
                                     ->where('judul', 'Visitor Permit Not Active (Expired)')
                                     ->exists();

                    if (!$exists) { // Cegah duplikasi
                        Histori::create([
                            'id_data' => $approved->visitor->id_visitor ?? null,
                            'id_akun' => Auth::user()->id ?? null,
                            'type' => "Visitor",
                            'judul' => "Visitor Permit Not Active (Expired)",
                            'text' => "Permit request visitor has expired: " . $approved->visitor->permit_number ?? null,
                        ]);
                    }
                    $statusUpdated = true;
                }
            }
        }

        // Check untuk Vendor
        if (!empty($approved->vendor->validity_date_to)) {
            $validityDateTo = Carbon::parse($approved->vendor->validity_date_to);
            if ($validityDateTo->isBefore(now()->toDateString())) {
                if ($approved->status !== 'Expired') {  // Hanya update jika status belum 'Expired'
                    $approved->status = 'Expired';
                    $approved->save();

                    $approved->vendor->status_aktif = 'Inactive';
                    $approved->vendor->save();

                    // Cek apakah histori sudah ada
                    $exists = Histori::where('id_data', $approved->vendor->id_vendor)
                                     ->where('type', 'Vendor')
                                     ->where('judul', 'Vendor Permit Not Active (Expired)')
                                     ->exists();

                    if (!$exists) { // Cegah duplikasi
                        Histori::create([
                            'id_data' => $approved->vendor->id_vendor ?? null,
                            'id_akun' => Auth::user()->id ?? null,
                            'type' => "Vendor",
                            'judul' => "Vendor Permit Not Active (Expired)",
                            'text' => "Permit request vendor has expired: " . $approved->vendor->permit_number ?? null,
                        ]);
                    }
                    $statusUpdated = true;
                }
            }
        }

        // Jika status tidak berubah, lanjutkan
        if (!$statusUpdated) {
            continue;
        }
    }


    // Pass the updated data to the view
    return view('permit-data', [
        "dataVendor" => $dataVendor,
        "dataVisitor" => $dataVisitor,
    "openCount" => $openCount,
        "closedCount" => $closedCount,
        "expiredCount" => $expiredCount,
        "totalCount" => $totalCount,
    ]);
}

public function updateStatus(Request $request)
{
    $permitId = $request->permit_id;
    $status = $request->status;

    // Find the permit in the 'approved' table by its ID
   $permit = Approved::with(['vendor', 'visitor'])->find($permitId);

    if ($permit) {
        // Update the status of the permit
        $permit->status = $status;
        $permit->save();

  if ($permit->type === 'Vendor' && $permit->vendor) {
            $permit->vendor->status_aktif = "Inactive";
            $permit->vendor->save();

                Histori::create([
                     'id_data' =>  $permit->vendor->id_vendor ?? null,
                     'id_akun' => Auth::user()->id ?? null,
                     'type' => "Vendor",
                     'judul' => "Vendor Permit Not Active (Closed)",
                    'text' => "Permit request vendor has been Closed is  " . $permit->vendor->permit_number ?? null,
]);
        }

        if ($permit->type === 'Visitor' && $permit->visitor) {
            $permit->visitor->status_aktif = "Inactive";
            $permit->visitor->save();

             Histori::create([
                     'id_data' =>  $permit->visitor->id_visitor ?? null,
                     'id_akun' => Auth::user()->id ?? null,
                     'type' => "Visitor",
                     'judul' => "Visitor Permit Not Active (Closed)",
                    'text' => "Permit request visitor has been Closed is  " . $permit->visitor->permit_number ?? null,
]);
        }

        // Return success response with the updated status
        return response()->json(['status' => 'success', 'updatedStatus' => $permit->status]);
    }

    // Return error response if permit not found
    return response()->json(['status' => 'error']);
}





}
