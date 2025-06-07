<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Vendor_Visitor;
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
         ->orWhere('mode', 'LIKE', "%{$search}%")->get();




        }else if($searchCompany){
            $vendors = $vendors->where('company_name', 'LIKE', "%{$searchCompany}%")->get();

}else{

    $vendors = $vendors->orderBy('created_at', 'desc')->get();
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
            'company_name' => 'required|string|max:255',
            'requestor_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'location_of_work' => 'required|string|max:255',
            'building_level_room' => 'required|string|max:255',
            'work_description' => 'required|string',
            'start_date' => 'required',
            'end_date' => 'required',
            'generate_dust' => 'required',
            'vehicle_types' => 'required',
            'number_plate' => 'required',
            'protection_system' => 'required|string',
            'file_mos' => 'file|mimes:pdf,doc,docx|max:10240',
            'worker1_name' => 'required|string|max:255',
            'worker1_id_nopermit' => 'required|string|max:255',
            'worker2_name' => 'required|string|max:255',
            'worker2_id_nopermit' => 'required|string|max:255',
            'worker3_name' => 'required|string|max:255',
            'worker3_id_nopermit' => 'required|string|max:255',
            'worker4_name' => 'required|string|max:255',
            'worker4_id_nopermit' => 'required|string|max:255',
            'worker5_name' => 'required|string|max:255',
            'worker5_id_nopermit' => 'required|string|max:255',

        ]);

   if ($request->hasFile('file_mos')) {
            // Store file in the 'mos_files' directory within 'public' disk
            $fileMos = $request->file('file_mos')->store('mos_files', 'public');
               Log::info('File Path:', ['file_mos' => $fileMos]);
        }


       $primaryNumber = $this->generateRandomPrimaryNumber();

        // Create Vendor record
        $vendor = Vendor::create([
            'company_name' => $validatedData['company_name'],
            'requestor_name' => $validatedData['requestor_name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'location_of_work' => $validatedData['location_of_work'],
            'building_level_room' => $validatedData['building_level_room'],
            'work_description' => $validatedData['work_description'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'generate_dust' => $validatedData['generate_dust'],
            'protection_system' => $validatedData['protection_system'],
            'number_plate' => $validatedData['number_plate'],
            'vehicle_types' => $validatedData['vehicle_types'],
            'file_mos' => $fileMos,
            'worker1_name' => $validatedData['worker1_name'],
            'worker1_id_nopermit' => $validatedData['worker1_id_nopermit'],
            'worker2_name' => $validatedData['worker2_name'],
            'worker2_id_nopermit' => $validatedData['worker2_id_nopermit'],
            'worker3_name' => $validatedData['worker3_name'],
            'worker3_id_nopermit' => $validatedData['worker3_id_nopermit'],
            'worker4_name' => $validatedData['worker4_name'],
            'worker4_id_nopermit' => $validatedData['worker4_id_nopermit'],
            'worker5_name' => $validatedData['worker5_name'],
            'worker5_id_nopermit' => $validatedData['worker5_id_nopermit'],
            'mode' => 'Urgent',
            'permit_number' =>  null,
            'primary_number' =>  $primaryNumber,
            'status' =>  'Pending',

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
