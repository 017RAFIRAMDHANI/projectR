<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Vendor_Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VendorController extends Controller
{

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
 public function approve(Request $request)
    {
        $vendor = Vendor::where('primary_number', $request->primary_number)->first();
        if ($vendor) {
            // Mengubah status menjadi Approved
            $vendor->status = 'Approved';

            // Generate Permit Number jika disetujui
            $permitNumber = $this->generatePermitNumber();
            $vendor->permit_number = $permitNumber;

            // Simpan data vendor dengan permit number baru
            $vendor->save();

            // Kirim email pemberitahuan ke vendor
            Mail::to($vendor->email)->send(new \App\Mail\VendorStatusMail($vendor, 'Approved', $permitNumber));
            Log::info('Email sent to: ' . $vendor->email . ' with permit number: ' . $permitNumber);

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function reject(Request $request)
    {
        $vendor = Vendor::where('primary_number', $request->primary_number)->first();
        if ($vendor) {
            // Mengubah status menjadi Reject
            $vendor->status = 'Reject';
            $vendor->save();

            // Kirim email pemberitahuan ke vendor
            Mail::to($vendor->email)->send(new \App\Mail\VendorStatusMail($vendor, 'Rejected'));

            return response()->json(['success' => true]);
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
         ->orWhere('location_of_work', 'LIKE', "%{$search}%")
         ->orWhere('building_level_room', 'LIKE', "%{$search}%")
         ->orWhere('work_description', 'LIKE', "%{$search}%")
         ->orWhere('email', 'LIKE', "%{$search}%")
         ->orWhere('phone_number', 'LIKE', "%{$search}%")
         ->orWhere('permit_number', 'LIKE', "%{$search}%")
         ->orWhere('start_date', 'LIKE', "%{$search}%")
         ->orWhere('end_date', 'LIKE', "%{$search}%")
         ->orWhere('number_plate', 'LIKE', "%{$search}%")
         ->orWhere('vehicle_types', 'LIKE', "%{$search}%")
         ->orWhere('worker1_name', 'LIKE', "%{$search}%")
         ->orWhere('worker1_id_nopermit', 'LIKE', "%{$search}%")
         ->orWhere('worker2_name', 'LIKE', "%{$search}%")
         ->orWhere('worker2_id_nopermit', 'LIKE', "%{$search}%")
         ->orWhere('worker3_name', 'LIKE', "%{$search}%")
         ->orWhere('worker3_id_nopermit', 'LIKE', "%{$search}%")
         ->orWhere('worker4_name', 'LIKE', "%{$search}%")
         ->orWhere('worker4_id_nopermit', 'LIKE', "%{$search}%")
         ->orWhere('worker5_name', 'LIKE', "%{$search}%")
         ->orWhere('worker5_id_nopermit', 'LIKE', "%{$search}%")
         ->orWhere('generate_dust', 'LIKE', "%{$search}%")
         ->orWhere('protection_system', 'LIKE', "%{$search}%")
         ->orWhere('file_mos', 'LIKE', "%{$search}%")
         ->orWhere('mode', 'LIKE', "%{$search}%")->paginate(2);




        }else if($searchCompany){
            $vendors = $vendors->where('company_name', 'LIKE', "%{$searchCompany}%")->paginate(2);

}else{

    $vendors = $vendors->orderBy('created_at', 'desc')->paginate(2);
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

public function store(Request $request)
{
    try {
        // Validate the incoming request data
      $validatedData = $request->validate([
        'email' => 'required|email',
        'validity_date_from' => 'required',
        'validity_date_to' => 'required',
        'validity_time_from' => 'required',
        'validity_time_to' => 'required',
        'company_name' => 'required|string|max:255',
        'requestor_name' => 'required|string|max:255',
        'company_contact' => 'required|string|max:255',
        'phone_number' => 'required|string|max:15',
        'location_of_work' => 'required|string|max:255',
        'building_level_room' => 'required|string|max:255',
        'purpose' => 'required|string|max:255',
        'purpose_details' => 'required|string',
        'total_worker' => 'nullable',
        'worker1_name' => 'required|string|max:255',
        'worker1_id_card' => 'required|string|max:255',
        'worker1_birthdate' => 'required',
        'generate_dust' => 'required',
        'state_cause' => 'nullable|string',
        'method' => 'nullable|string',
        'any_fire' => 'required',
        'isolation_of' => 'nullable',
        'isolation_name' => 'nullable|string|max:255',
        'isolation_date' => 'nullable',
        'file_mos' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        'number_plate' => 'nullable|string|max:255',
        'vehicle_types' => 'nullable',
    ]);

   if ($request->hasFile('file_mos')) {
            // Store file in the 'mos_files' directory within 'public' disk
            $fileMos = $request->file('file_mos')->store('mos_files', 'public');
               Log::info('File Path:', ['file_mos' => $fileMos]);
        }


       //$primaryNumber = $this->generateRandomPrimaryNumber();
    $isolationOf = $request->has('isolation_of') ? implode(',', $request->isolation_of) : null;

        // Create Vendor record
        $vendor = Vendor::create([
             'email' => $request->email,
    'validity_date_from' => Carbon::parse($request->validity_date_from)->format('Y-m-d'),
    'validity_date_to' => Carbon::parse($request->validity_date_to)->format('Y-m-d'),
    'validity_time_from' => $request->validity_time_from,
    'validity_time_to' => $request->validity_time_to,
    'company_name' => $request->company_name,
    'requestor_name' => $request->requestor_name,
    'company_contact' => $request->company_contact,
    'phone_number' => $request->phone_number,
    'location_of_work' => $request->location_of_work,
    'building_level_room' => $request->building_level_room,
    'purpose' => $request->purpose,
    'purpose_details' => $request->purpose_details,
    'total_worker' => $request->total_worker,
    'worker1_name' => $request->worker1_name,
    'worker1_id_card' => $request->worker1_id_card,
    'worker1_birthdate' => Carbon::parse($request->worker1_birthdate)->format('Y-m-d'),
    'worker2_name' => $request->worker2_name,
    'worker2_id_card' => $request->worker2_id_card,
    'worker2_birthdate' => Carbon::parse($request->worker2_birthdate)->format('Y-m-d'),
    'worker3_name' => $request->worker3_name,
    'worker3_id_card' => $request->worker3_id_card,
    'worker3_birthdate' => Carbon::parse($request->worker3_birthdate)->format('Y-m-d'),
    'worker4_name' => $request->worker4_name,
    'worker4_id_card' => $request->worker4_id_card,
    'worker4_birthdate' => Carbon::parse($request->worker4_birthdate)->format('Y-m-d'),
    'worker5_name' => $request->worker5_name,
    'worker5_id_card' => $request->worker5_id_card,
    'worker5_birthdate' => Carbon::parse($request->worker5_birthdate)->format('Y-m-d'),
    'worker6_name' => $request->worker6_name,
    'worker6_id_card' => $request->worker6_id_card,
    'worker6_birthdate' => Carbon::parse($request->worker6_birthdate)->format('Y-m-d'),
    'worker7_name' => $request->worker7_name,
    'worker7_id_card' => $request->worker7_id_card,
    'worker7_birthdate' => Carbon::parse($request->worker7_birthdate)->format('Y-m-d'),
    'worker8_name' => $request->worker8_name,
    'worker8_id_card' => $request->worker8_id_card,
    'worker8_birthdate' => Carbon::parse($request->worker8_birthdate)->format('Y-m-d'),
    'worker9_name' => $request->worker9_name,
    'worker9_id_card' => $request->worker9_id_card,
    'worker9_birthdate' => Carbon::parse($request->worker9_birthdate)->format('Y-m-d'),
    'worker10_name' => $request->worker10_name,
    'worker10_id_card' => $request->worker10_id_card,
    'worker10_birthdate' => Carbon::parse($request->worker10_birthdate)->format('Y-m-d'),
    'generate_dust' => $request->generate_dust,
    'state_cause' => $request->state_cause,
    'method' => $request->method,
    'any_fire' => $request->any_fire,
    'isolation_of' => $isolationOf,
    'isolation_name' => $request->isolation_name,
    'isolation_date' => $request->isolation_date ? Carbon::parse($request->isolation_date)->format('Y-m-d H:i:s') : null,
    'file_mos' => isset($fileMos) ? $fileMos : null,
    'number_plate' => $request->number_plate,
    'vehicle_types' => $request->vehicle_types,
    'status' => 'Pending',
    'mode' => 'Urgent',
        ]);
              $id_vendor = $vendor->id_vendor;


            Vendor_Visitor::create([
                  'id_vendor' => $id_vendor,
                  'type' => 'Vendor',
                  'mode' => 'Urgent',

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
