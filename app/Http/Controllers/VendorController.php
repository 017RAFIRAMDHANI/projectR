<?php

namespace App\Http\Controllers;

use App\Models\Approved;
use App\Models\Histori;
use App\Models\Safeti;
use App\Models\Vehicle;
use App\Models\Vendor;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{


 public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();

    }

 public function approve(Request $request)
    {
        $vendor = Vendor::where('id_vendor', $request->id_vendor)->first();
        if ($vendor) {

             if ($vendor->permit_number) {
            return back();
        }

          $noted = $request->approved ?? ' '; // Jika tidak ada nilai, beri default 'No notes provided'

            $vendor->note_vendor = $noted;
            // Mengubah status menjadi Approved
            $vendor->status = 'Approved';

            // Generate Permit Number jika disetujui
            $permitNumber = $this->generatePermitNumber();
            $vendor->permit_number = $permitNumber;
            $vendor->pdf_nama = Auth::user()->name;
            $vendor->pdf_jabatan = Auth::user()->role;
            $vendor->status_aktif = "Active";
          $vendor->save();
        $pdfContent = view('pdf_permit', compact('vendor', 'permitNumber'))->render();

        // Create PDF from HTML content
        $pdf = FacadePdf::loadHTML($pdfContent);

        // Save the generated PDF in storage
        $filePath = storage_path('app/public/permit_to_work_' . $permitNumber . '.pdf');
        $pdf->save($filePath);

        // Kirim email pemberitahuan ke vendor
       Mail::to($vendor->email)->send(new \App\Mail\VendorStatusMail($vendor, 'Approved', $permitNumber,$filePath));
            // Log::info('Email sent to: ' . $vendor->email . ' with permit number: ' . $permitNumber);
    Approved::create([
                  'id_vendor' => $request->id_vendor ?? null,
                  'type' => 'Vendor',
                  'status' => 'Open',
            ]);

           for ($i = 1; $i <= 30; $i++) {
            $fieldName = "worker{$i}_name";
            $fieldName2 = "worker{$i}_id_card";
            $workerName = $vendor->$fieldName;
            $workerIdCard = $vendor->$fieldName2;

            // Cek apakah ada nama yang diisi
            if (!empty($workerName) && trim($workerName) !== '') {
                Safeti::create([
                    'id_vendor' => $vendor->id_vendor,
                    'status_safeti' => 'Inactive',
                    'type' => 'Vendor',
                    'name' => $workerName,
                    'id_card' => $workerIdCard,
                    'company_name' => $vendor->company_name ?? '',
                ]);

            }
        }

           Histori::create([
    'id_data' => $vendor->id_vendor ?? null,
    'id_akun' => Auth::user()->id ?? null,
    'type' => "Vendor",
    'judul' => "Work Permit Approval",
    'text' => "Work permit request on behalf of " . ( $vendor->requestor_name ?? ' ' ). " approved by " . ( Auth::user()->name ?? ' '),
   ]);


           return back()->with('success', 'Permit Approve Success');
        }
        return response()->json(['success' => false], 404);
    }

    public function reject(Request $request)
    {
        $vendor = Vendor::where('id_vendor', $request->id_vendor)->first();
       // dd($request->all());
        if ($vendor) {
            // Mengubah status menjadi Reject
      $noted = $request->rejected ?? ' '; // Jika tidak ada nilai, beri default 'No notes provided'

$vendor->note_vendor = $noted;
  $vendor->status = 'Rejected';
$vendor->save();

            // Kirim email pemberitahuan ke vendor
            Mail::to($vendor->email)->send(new \App\Mail\VendorStatusMail($vendor, 'Rejected' ));


            Histori::create([
    'id_data' => $vendor->id_vendor ?? null,
    'id_akun' => Auth::user()->id ?? null,
    'type' => "Vendor",
    'judul' => "Work Permit Rejected",
    'text' => "Work request has been rejected vendor " . ($vendor->requestor_name ?? ' ' ). " rejected by " . ( Auth::user()->name ?? ' ')
]);


           return back()->with('success', 'Permit Rejected Success');

        }
        return response()->json(['success' => false], 404);
    }

    // Fungsi untuk generate permit number yang unik
    public function generatePermitNumber()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $permitNumber = '';
        $length = 8;

        // Generate nomor acak
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $permitNumber .= $characters[$randomIndex];
        }

        return 'VD-' . date('Ym') . '-' . $permitNumber; // Format: VD-YYYYMM-8digitunik
    }
public function index(Request $request)
{
   $search = $request->input('searchData');
   $searchCompany = $request->input('searchCompany');

   $vendors = Vendor::query();




   if ($search) {
      // Apply the search filters
      $vendors = $vendors->where('company_name', 'LIKE', "%{$search}%")
         ->orWhere('requestor_name', 'LIKE', "%{$search}%")
        ->paginate(20);




        }else if($searchCompany){
            $vendors = $vendors->where('company_name', 'LIKE', "%{$searchCompany}%")->paginate(20);

}else{

    $vendors = $vendors->orderBy('created_at', 'desc')->paginate(20);
}

   // Apply ordering and pagination
    $vendorOne = Vendor::whereNotNull('file_mos')->first();
   return view('permits', [
       'vendors' => $vendors,
       'search' => $search,
       'vendorOne' => $vendorOne,

   ]);
}


      public function create()
{
        return view('new-permit');
}
 public function info(Request $request)
    {
        $vendor = Vendor::where('id_vendor', $request->id_vendor)->first();

       // dd($request->all());
        if ($vendor) {
            // Mengubah status menjadi Reject
      $noted = $request->infoted ?? ' '; // Jika tidak ada nilai, beri default 'No notes provided'

$vendor->note_vendor = $noted;
//   $vendor->status = 'Pending';
$vendor->save();

            // Kirim email pemberitahuan ke vendor
            Mail::to($vendor->email)->send(new \App\Mail\VendorStatusMail($vendor, 'Request for more information' ));

            Histori::create([
    'id_data' => $vendor->id_vendor ?? null,
    'id_akun' => Auth::user()->id ?? null,
    'type' => "Vendor",
    'judul' => "Work Permit Infoted",
    'text' => "Work permit request on behalf of " . ( $vendor->pic_name ?? ' ' ). " infoted by " . ( Auth::user()->name ?? ' '),

]);

           return back()->with('success', 'Permit information successful');

        }
        return response()->json(['success' => false], 404);
    }
public function store(Request $request)
{
     //dd($request->all());
    try {
        // Validate the incoming request data
    $validatedData = $request->validate([
        'email' => 'required',
        'company_name' => 'required|string|max:255',
        'company_contact' => 'required|string|max:255',
        'requestor_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:15',
        'validity_date_from' => 'required|date',
        'validity_date_to' => 'required|date',
        'work_description' => 'nullable|string',
        'building' => 'nullable|string',
        'level' => 'nullable|string',
        'specific_location' => 'nullable|string',
        'vehicle_types' => 'nullable|string',
        'number_plate' => 'nullable|string',
     'worker1_name' => 'nullable|string|max:255',
'worker1_id_card' => 'nullable|string|max:255',
'worker2_name' => 'nullable|string|max:255',
'worker2_id_card' => 'nullable|string|max:255',
'worker3_name' => 'nullable|string|max:255',
'worker3_id_card' => 'nullable|string|max:255',
'worker4_name' => 'nullable|string|max:255',
'worker4_id_card' => 'nullable|string|max:255',
'worker5_name' => 'nullable|string|max:255',
'worker5_id_card' => 'nullable|string|max:255',
'worker6_name' => 'nullable|string|max:255',
'worker6_id_card' => 'nullable|string|max:255',
'worker7_name' => 'nullable|string|max:255',
'worker7_id_card' => 'nullable|string|max:255',
'worker8_name' => 'nullable|string|max:255',
'worker8_id_card' => 'nullable|string|max:255',
'worker9_name' => 'nullable|string|max:255',
'worker9_id_card' => 'nullable|string|max:255',
'worker10_name' => 'nullable|string|max:255',
'worker10_id_card' => 'nullable|string|max:255',
'worker11_name' => 'nullable|string|max:255',
'worker11_id_card' => 'nullable|string|max:255',
'worker12_name' => 'nullable|string|max:255',
'worker12_id_card' => 'nullable|string|max:255',
'worker13_name' => 'nullable|string|max:255',
'worker13_id_card' => 'nullable|string|max:255',
'worker14_name' => 'nullable|string|max:255',
'worker14_id_card' => 'nullable|string|max:255',
'worker15_name' => 'nullable|string|max:255',
'worker15_id_card' => 'nullable|string|max:255',
'worker16_name' => 'nullable|string|max:255',
'worker16_id_card' => 'nullable|string|max:255',
'worker17_name' => 'nullable|string|max:255',
'worker17_id_card' => 'nullable|string|max:255',
'worker18_name' => 'nullable|string|max:255',
'worker18_id_card' => 'nullable|string|max:255',
'worker19_name' => 'nullable|string|max:255',
'worker19_id_card' => 'nullable|string|max:255',
'worker20_name' => 'nullable|string|max:255',
'worker20_id_card' => 'nullable|string|max:255',
'worker21_name' => 'nullable|string|max:255',
'worker21_id_card' => 'nullable|string|max:255',
'worker22_name' => 'nullable|string|max:255',
'worker22_id_card' => 'nullable|string|max:255',
'worker23_name' => 'nullable|string|max:255',
'worker23_id_card' => 'nullable|string|max:255',
'worker24_name' => 'nullable|string|max:255',
'worker24_id_card' => 'nullable|string|max:255',
'worker25_name' => 'nullable|string|max:255',
'worker25_id_card' => 'nullable|string|max:255',
'worker26_name' => 'nullable|string|max:255',
'worker26_id_card' => 'nullable|string|max:255',
'worker27_name' => 'nullable|string|max:255',
'worker27_id_card' => 'nullable|string|max:255',
'worker28_name' => 'nullable|string|max:255',
'worker28_id_card' => 'nullable|string|max:255',
'worker29_name' => 'nullable|string|max:255',
'worker29_id_card' => 'nullable|string|max:255',
'worker30_name' => 'nullable|string|max:255',
'worker30_id_card' => 'nullable|string|max:255',

        'generate_dust' => 'nullable|string',
        'fire_system' => 'nullable|string',

        'isolation_name' => 'nullable|string',
        'isolation_date' => 'nullable',
        'up_id_card_foto' => 'nullable|file|mimes:jpg,png,pdf|max:10240',  // Contoh validasi file
        'file_mos' => 'nullable|file|mimes:jpg,png,pdf|max:10240', // Contoh validasi file

        'check_one_approve' => 'nullable|integer',
        'permit_number' => 'nullable|string|max:255',
        'status' => 'nullable|string',
        'mode' => 'nullable|string',
    ]);

   if ($request->hasFile('up_id_card_foto')) {
            // Store file in the 'mos_files' directory within 'public' disk
            $fileCard = $request->file('up_id_card_foto')->store('up_id_card_foto', 'public');
               Log::info('File Path:', ['up_id_card_foto' => $fileCard]);
        }
   if ($request->hasFile('file_mos')) {
            // Store file in the 'mos_files' directory within 'public' disk
            $fileMos = $request->file('file_mos')->store('mos_files', 'public');
               Log::info('File Path:', ['file_mos' => $fileMos]);
        }


       //$primaryNumber = $this->generateRandomPrimaryNumber();
       //$isolationOf = $request->has('isolation_of') ? implode(',', $request->isolation_of) : null;


$vendor = Vendor::create([
  'email' => $validatedData['email'] ?? null,  // Menggunakan null coalescing operator
    'company_name' => $validatedData['company_name'] ?? null,
    'company_contact' => $validatedData['company_contact'] ?? null,
    'requestor_name' => $validatedData['requestor_name'] ?? null,
    'phone_number' => $validatedData['phone_number'] ?? null,
    'validity_date_from' => $validatedData['validity_date_from'] ?? null,
    'validity_date_to' => $validatedData['validity_date_to'] ?? null,
    'work_description' => $validatedData['work_description'] ?? null,
    'building' => $validatedData['building'] ?? null,
    'level' => $validatedData['level'] ?? null,
    'specific_location' => $validatedData['specific_location'] ?? null,
    'vehicle_types' => $validatedData['vehicle_types'] ?? null,
    'number_plate' => $validatedData['number_plate'] ?? null,
    'worker1_name' => $validatedData['worker1_name'] ?? null,
    'worker1_id_card' => $validatedData['worker1_id_card'] ?? null,
    'worker2_name' => $validatedData['worker2_name'] ?? null,
    'worker2_id_card' => $validatedData['worker2_id_card'] ?? null,
    'worker3_name' => $validatedData['worker3_name'] ?? null,
    'worker3_id_card' => $validatedData['worker3_id_card'] ?? null,
    'worker4_name' => $validatedData['worker4_name'] ?? null,
    'worker4_id_card' => $validatedData['worker4_id_card'] ?? null,
    'worker5_name' => $validatedData['worker5_name'] ?? null,
    'worker5_id_card' => $validatedData['worker5_id_card'] ?? null,
    'worker6_name' => $validatedData['worker6_name'] ?? null,
    'worker6_id_card' => $validatedData['worker6_id_card'] ?? null,
    'worker7_name' => $validatedData['worker7_name'] ?? null,
    'worker7_id_card' => $validatedData['worker7_id_card'] ?? null,
    'worker8_name' => $validatedData['worker8_name'] ?? null,
    'worker8_id_card' => $validatedData['worker8_id_card'] ?? null,
    'worker9_name' => $validatedData['worker9_name'] ?? null,
    'worker9_id_card' => $validatedData['worker9_id_card'] ?? null,
    'worker10_name' => $validatedData['worker10_name'] ?? null,
    'worker10_id_card' => $validatedData['worker10_id_card'] ?? null,
    'worker11_name' => $validatedData['worker11_name'] ?? null,
    'worker11_id_card' => $validatedData['worker11_id_card'] ?? null,
    'worker12_name' => $validatedData['worker12_name'] ?? null,
    'worker12_id_card' => $validatedData['worker12_id_card'] ?? null,
    'worker13_name' => $validatedData['worker13_name'] ?? null,
    'worker13_id_card' => $validatedData['worker13_id_card'] ?? null,
    'worker14_name' => $validatedData['worker14_name'] ?? null,
    'worker14_id_card' => $validatedData['worker14_id_card'] ?? null,
    'worker15_name' => $validatedData['worker15_name'] ?? null,
    'worker15_id_card' => $validatedData['worker15_id_card'] ?? null,
    'worker16_name' => $validatedData['worker16_name'] ?? null,
    'worker16_id_card' => $validatedData['worker16_id_card'] ?? null,
    'worker17_name' => $validatedData['worker17_name'] ?? null,
    'worker17_id_card' => $validatedData['worker17_id_card'] ?? null,
    'worker18_name' => $validatedData['worker18_name'] ?? null,
    'worker18_id_card' => $validatedData['worker18_id_card'] ?? null,
    'worker19_name' => $validatedData['worker19_name'] ?? null,
    'worker19_id_card' => $validatedData['worker19_id_card'] ?? null,
    'worker20_name' => $validatedData['worker20_name'] ?? null,
    'worker20_id_card' => $validatedData['worker20_id_card'] ?? null,
    'worker21_name' => $validatedData['worker21_name'] ?? null,
    'worker21_id_card' => $validatedData['worker21_id_card'] ?? null,
    'worker22_name' => $validatedData['worker22_name'] ?? null,
    'worker22_id_card' => $validatedData['worker22_id_card'] ?? null,
    'worker23_name' => $validatedData['worker23_name'] ?? null,
    'worker23_id_card' => $validatedData['worker23_id_card'] ?? null,
    'worker24_name' => $validatedData['worker24_name'] ?? null,
    'worker24_id_card' => $validatedData['worker24_id_card'] ?? null,
    'worker25_name' => $validatedData['worker25_name'] ?? null,
    'worker25_id_card' => $validatedData['worker25_id_card'] ?? null,
    'worker26_name' => $validatedData['worker26_name'] ?? null,
    'worker26_id_card' => $validatedData['worker26_id_card'] ?? null,
    'worker27_name' => $validatedData['worker27_name'] ?? null,
    'worker27_id_card' => $validatedData['worker27_id_card'] ?? null,
    'worker28_name' => $validatedData['worker28_name'] ?? null,
    'worker28_id_card' => $validatedData['worker28_id_card'] ?? null,
    'worker29_name' => $validatedData['worker29_name'] ?? null,
    'worker29_id_card' => $validatedData['worker29_id_card'] ?? null,
    'worker30_name' => $validatedData['worker30_name'] ?? null,
    'worker30_id_card' => $validatedData['worker30_id_card'] ?? null,
    'generate_dust' => $validatedData['generate_dust'] ?? null,
    'fire_system' => $validatedData['fire_system'] ?? null,
    'isolation_of' => $request->has('isolation_of') ? implode(',', $request->isolation_of) : null,
    'isolation_name' => $validatedData['isolation_name'] ?? null,
       'isolation_date' => $request->isolation_date ? Carbon::parse($request->isolation_date)->format('Y-m-d H:i:s') : null,
        'up_id_card_foto' => $fileCard ?? null,
        'file_mos' => $fileMos ?? null,
        'status' => 'Pending',
        'mode' => $request->mode ?? null,
    ]);

// Log::info('Vendor created successfully', $vendor->toArray());

      Mail::to($vendor->email)->send(new \App\Mail\VendorForm($vendor));

              $id_vendor = $vendor->id_vendor;


            Vehicle::create([
                'name' => $validatedData['requestor_name'] ?? null,
                'number_plate' => $validatedData['number_plate'] ?? null,
                'type' => $validatedData['vehicle_types'] ?? null,
                'company' => $validatedData['company_name'] ?? null,
                'date_from' =>$validatedData['validity_date_from'] ?? null,
                'date_to' => $validatedData['validity_date_to'] ?? null,
                'id_vendor' => $id_vendor ?? null,
                'status' => 'Active',
            ]);

        Histori::create([
             'id_data' => $vendor->id_vendor ?? null,
             'id_akun' => Auth::user()->id ?? null,
             'type' => "Vendor",
             'judul' => "New Permit Request",
            'text' => "Work permit from " . $vendor->requestor_name ?? null,
            ]);

        // Return a success response with data
        return redirect()->route('index_approve')->with('success', 'Vendor permit request submitted successfully!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Handle validation errors
        $errors = $e->validator->errors();
        Log::error('Validation Errors:', $errors->all());
        return back()->withErrors($errors)->withInput();

    } catch (\Exception $e) {
        // Log the exception error
        Log::error('Error submitting vendor permit request', ['error' => $e->getMessage()]);
        return back()->with('error', 'There was an error submitting the form. Please try again.');
    }
}

  public function generateRandomPrimaryNumber()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // Karakter yang bisa digunakan (huruf besar dan angka)
        $primaryNumber = '';
        $length = 8; // Panjang primary_number (8 karakter)

        // Loop untuk menggenerate primary_number
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1); // Pilih karakter acak
            $primaryNumber .= $characters[$randomIndex]; // Tambahkan karakter ke primary_number
        }

        return $primaryNumber; // Kembalikan primary_number yang sudah digenerate
    }

}

// public function search(Request $request)
// {
//     $search = $request->input('searchData'); // Ambil data pencarian
// if($search) {

//   $vendors = Vendor::where('company_name', 'LIKE', "%{$search}%")
//     ->orWhere('requestor_name', 'LIKE', "%{$search}%")
//     ->orWhere('location_of_work', 'LIKE', "%{$search}%")
//     ->orWhere('building_level_room', 'LIKE', "%{$search}%")
//     ->orWhere('work_description', 'LIKE', "%{$search}%")
//     ->orWhere('email', 'LIKE', "%{$search}%")
//     ->orWhere('phone_number', 'LIKE', "%{$search}%")
//     ->orWhere('permit_number', 'LIKE', "%{$search}%")
//     ->orWhere('start_date', 'LIKE', "%{$search}%")
//     ->orWhere('end_date', 'LIKE', "%{$search}%")
//     ->orWhere('number_plate', 'LIKE', "%{$search}%")
//     ->orWhere('vehicle_types', 'LIKE', "%{$search}%")
//     ->orWhere('worker1_name', 'LIKE', "%{$search}%")
//     ->orWhere('worker1_id_nopermit', 'LIKE', "%{$search}%")
//     ->orWhere('worker2_name', 'LIKE', "%{$search}%")
//     ->orWhere('worker2_id_nopermit', 'LIKE', "%{$search}%")
//     ->orWhere('worker3_name', 'LIKE', "%{$search}%")
//     ->orWhere('worker3_id_nopermit', 'LIKE', "%{$search}%")
//     ->orWhere('worker4_name', 'LIKE', "%{$search}%")
//     ->orWhere('worker4_id_nopermit', 'LIKE', "%{$search}%")
//     ->orWhere('worker5_name', 'LIKE', "%{$search}%")
//     ->orWhere('worker5_id_nopermit', 'LIKE', "%{$search}%")
//     ->orWhere('generate_dust', 'LIKE', "%{$search}%")
//     ->orWhere('protection_system', 'LIKE', "%{$search}%")
//     ->orWhere('file_mos', 'LIKE', "%{$search}%")
//     ->orWhere('mode', 'LIKE', "%{$search}%")
//     ->get();

//     return response()->json($vendors);

//    }




    // Kembalikan data ke JavaScript dalam format JSON
//}
