<?php

namespace App\Http\Controllers;

use App\Models\Approved;
use App\Models\Histori;
use App\Models\Safeti;
use App\Models\Vehicle;
use App\Models\Visitor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VisitorController extends Controller


{
    public function index(Request $request)
{
 // return view('visitor-dashboard');

}
      public function __construct()
    {
        $this->middleware('auth');


    }
 public function reject(Request $request)
    {
        $visitor = Visitor::where('id_visitor', $request->id_visitor)->first();

       // dd($request->all());
        if ($visitor) {
            // Mengubah status menjadi Reject
      $noted = $request->rejected ?? ' '; // Jika tidak ada nilai, beri default 'No notes provided'

$visitor->note_visitor = $noted;
  $visitor->status = 'Rejected';
$visitor->save();

            // Kirim email pemberitahuan ke visitor
            Mail::to($visitor->email)->send(new \App\Mail\VisitorStatusMail($visitor, 'Rejected' ));

            Histori::create([
    'id_data' => $visitor->id_visitor ?? null,
    'id_akun' => Auth::user()->id ?? null,
    'type' => "Visitor",
    'judul' => "Visitor Permit Rejected",
    'text' => "Visitor permit request on behalf of " . ( $visitor->pic_name ?? ' ' ). " approved by " . ( Auth::user()->name ?? ' '),

]);

           return back()->with('success', 'Permit Rejected Success');

        }
        return response()->json(['success' => false], 404);
    }

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

        return 'VS-' . date('Ym') . '-' . $permitNumber; // Format: VD-YYYYMM-8digitunik
    }
 public function approve(Request $request)
    {
        $visitor = Visitor::where('id_visitor', $request->id_visitor)->first();
        if ($visitor) {
            // Mengubah status menjadi Approved
            $visitor->status = 'Approved';

            // Generate Permit Number jika disetujui
            $permitNumber = $this->generatePermitNumber();
            $visitor->permit_number = $permitNumber;
            $visitor->pdf_nama =  Auth::user()->name;
            $visitor->pdf_jabatan=  Auth::user()->role;
            $visitor->status_aktif=  "Active";
          $visitor->save();
        $pdfContent = view('pdf_permit_v', compact('visitor', 'permitNumber'))->render();

        // Create PDF from HTML content
        $pdf = FacadePdf::loadHTML($pdfContent);

        // Save the generated PDF in storage
        $filePath = storage_path('app/public/permit_to_work_' . $permitNumber . '.pdf');
        $pdf->save($filePath);

        // Kirim email pemberitahuan ke visitor
       Mail::to($visitor->email)->send(new \App\Mail\VisitorStatusMail($visitor, 'Approved', $permitNumber,$filePath));
            // Log::info('Email sent to: ' . $vendor->email . ' with permit number: ' . $permitNumber);
        Approved::create([
                  'id_visitor' => $request->id_visitor ?? null,
                  'type' => 'Visitor',
                  'status' => 'Open',
            ]);


              for ($i = 1; $i <= 30; $i++) {
            $fieldName = "name_{$i}";
            $workerName = $visitor->$fieldName;

            // Cek apakah ada nama yang diisi
            if (!empty($workerName) && trim($workerName) !== '') {
                Safeti::create([
                    'id_visitor' => $visitor->id_visitor,
                    'status_safeti' => 'Inactive',
                    'type' => 'Visitor',
                    'name' => $workerName,
                    'company_name' => $visitor->company_name ?? '',
                ]);

            }


        }

        Histori::create([
    'id_data' => $visitor->id_visitor ?? null,
    'id_akun' => Auth::user()->id ?? null,
    'type' => "Visitor",
    'judul' => "Visitor Permit Approval",
    'text' => "Permit request for visitor " . $visitor->pic_name ?? null . " has been approved and is now valid.",
   ]);


           return back()->with('success', 'Permit Approve Success');
        }
        return response()->json(['success' => false], 404);
    }

   public function store(Request $request)
{
  //   dd($request->all());
    try {
        // Validate the incoming request data
   $validatedData = $request->validate([
    'email' => 'required|email',
    'company_name' => 'required',
    'request_date_from' => 'nullable|date',
    'request_date_to' => 'nullable|date',
    'purpose_visit' => 'nullable|string|max:255',
    'purpose_detail' => 'nullable|string|max:255',
    'building' => 'nullable|string|max:255',
    'level' => 'nullable|string|max:255',
    'specific_location' => 'nullable|string|max:255',
    'pic_name' => 'nullable|string|max:255',
    'pic_contact' => 'nullable|string|max:255',
    'car_plate_no' => 'nullable|string|max:255',
    'vehicle_type' => 'nullable|string|max:255',
    'name_1' => 'nullable|string|max:255',
    'id_card_1' => 'nullable|string|max:255',
    'name_2' => 'nullable|string|max:255',
    'id_card_2' => 'nullable|string|max:255',
    'name_3' => 'nullable|string|max:255',
    'id_card_3' => 'nullable|string|max:255',
    'name_4' => 'nullable|string|max:255',
    'id_card_4' => 'nullable|string|max:255',
    'name_5' => 'nullable|string|max:255',
    'id_card_5' => 'nullable|string|max:255',
    'name_6' => 'nullable|string|max:255',
    'id_card_6' => 'nullable|string|max:255',
    'name_7' => 'nullable|string|max:255',
    'id_card_7' => 'nullable|string|max:255',
    'name_8' => 'nullable|string|max:255',
    'id_card_8' => 'nullable|string|max:255',
    'name_9' => 'nullable|string|max:255',
    'id_card_9' => 'nullable|string|max:255',
    'name_10' => 'nullable|string|max:255',
    'id_card_10' => 'nullable|string|max:255',
    'name_11' => 'nullable|string|max:255',
    'id_card_11' => 'nullable|string|max:255',
    'name_12' => 'nullable|string|max:255',
    'id_card_12' => 'nullable|string|max:255',
    'name_13' => 'nullable|string|max:255',
    'id_card_13' => 'nullable|string|max:255',
    'name_14' => 'nullable|string|max:255',
    'id_card_14' => 'nullable|string|max:255',
    'name_15' => 'nullable|string|max:255',
    'id_card_15' => 'nullable|string|max:255',
    'name_16' => 'nullable|string|max:255',
    'id_card_16' => 'nullable|string|max:255',
    'name_17' => 'nullable|string|max:255',
    'id_card_17' => 'nullable|string|max:255',
    'name_18' => 'nullable|string|max:255',
    'id_card_18' => 'nullable|string|max:255',
    'name_19' => 'nullable|string|max:255',
    'id_card_19' => 'nullable|string|max:255',
    'name_20' => 'nullable|string|max:255',
    'id_card_20' => 'nullable|string|max:255',
    'name_21' => 'nullable|string|max:255',
    'id_card_21' => 'nullable|string|max:255',
    'name_22' => 'nullable|string|max:255',
    'id_card_22' => 'nullable|string|max:255',
    'name_23' => 'nullable|string|max:255',
    'id_card_23' => 'nullable|string|max:255',
    'name_24' => 'nullable|string|max:255',
    'id_card_24' => 'nullable|string|max:255',
    'name_25' => 'nullable|string|max:255',
    'id_card_25' => 'nullable|string|max:255',
    'name_26' => 'nullable|string|max:255',
    'id_card_26' => 'nullable|string|max:255',
    'name_27' => 'nullable|string|max:255',
    'id_card_27' => 'nullable|string|max:255',
    'name_28' => 'nullable|string|max:255',
    'id_card_28' => 'nullable|string|max:255',
    'name_29' => 'nullable|string|max:255',
    'id_card_29' => 'nullable|string|max:255',
    'name_30' => 'nullable|string|max:255',
    'id_card_30' => 'nullable|string|max:255',
    'material_1' => 'nullable|string|max:255',
    'quantity_1' => 'nullable|string|max:255',
    'material_2' => 'nullable|string|max:255',
    'quantity_2' => 'nullable|string|max:255',
    'material_3' => 'nullable|string|max:255',
    'quantity_3' => 'nullable|string|max:255',
    'material_4' => 'nullable|string|max:255',
    'quantity_4' => 'nullable|string|max:255',
    'material_5' => 'nullable|string|max:255',
    'quantity_5' => 'nullable|string|max:255',
    'material_6' => 'nullable|string|max:255',
    'quantity_6' => 'nullable|string|max:255',
    'material_7' => 'nullable|string|max:255',
    'quantity_7' => 'nullable|string|max:255',
    'material_8' => 'nullable|string|max:255',
    'quantity_8' => 'nullable|string|max:255',
    'material_9' => 'nullable|string|max:255',
    'quantity_9' => 'nullable|string|max:255',
    'material_10' => 'nullable|string|max:255',
    'quantity_10' => 'nullable|string|max:255',
    'material_11' => 'nullable|string|max:255',
    'quantity_11' => 'nullable|string|max:255',
    'material_12' => 'nullable|string|max:255',
    'quantity_12' => 'nullable|string|max:255',
    'material_13' => 'nullable|string|max:255',
    'quantity_13' => 'nullable|string|max:255',
    'material_14' => 'nullable|string|max:255',
    'quantity_14' => 'nullable|string|max:255',
    'material_15' => 'nullable|string|max:255',
    'quantity_15' => 'nullable|string|max:255',
    'material_16' => 'nullable|string|max:255',
    'quantity_16' => 'nullable|string|max:255',
    'material_17' => 'nullable|string|max:255',
    'quantity_17' => 'nullable|string|max:255',
    'material_18' => 'nullable|string|max:255',
    'quantity_18' => 'nullable|string|max:255',
    'material_19' => 'nullable|string|max:255',
    'quantity_19' => 'nullable|string|max:255',
    'material_20' => 'nullable|string|max:255',
    'quantity_20' => 'nullable|string|max:255',
    'material_21' => 'nullable|string|max:255',
    'quantity_21' => 'nullable|string|max:255',
    'material_22' => 'nullable|string|max:255',
    'quantity_22' => 'nullable|string|max:255',
    'material_23' => 'nullable|string|max:255',
    'quantity_23' => 'nullable|string|max:255',
    'material_24' => 'nullable|string|max:255',
    'quantity_24' => 'nullable|string|max:255',
    'material_25' => 'nullable|string|max:255',
    'quantity_25' => 'nullable|string|max:255',
    'material_26' => 'nullable|string|max:255',
    'quantity_26' => 'nullable|string|max:255',
    'material_27' => 'nullable|string|max:255',
    'quantity_27' => 'nullable|string|max:255',
    'material_28' => 'nullable|string|max:255',
    'quantity_28' => 'nullable|string|max:255',
    'material_29' => 'nullable|string|max:255',
    'quantity_29' => 'nullable|string|max:255',
    'material_30' => 'nullable|string|max:255',
    'quantity_30' => 'nullable|string|max:255',
    'upload_id_card_foto' => 'nullable|file|mimes:jpeg,png,jpg|max:10240',
    'primary_number' => 'nullable|string|max:255',
    'permit_number' => 'nullable|string|max:255',
    'status' => 'nullable|string|max:255',

]);


   if ($request->hasFile('upload_id_card_foto')) {
            // Store file in the 'mos_files' directory within 'public' disk
            $fileCard = $request->file('upload_id_card_foto')->store('upload_id_card_foto', 'public');
               Log::info('File Path:', ['upload_id_card_foto' => $fileCard]);
        }

        $visitor = Visitor::create([
    'email' => $validatedData['email'] ?? null,
    'company_name' => $validatedData['company_name'] ?? null,
    'request_date_from' => $validatedData['request_date_from'] ?? null,
    'request_date_to' => $validatedData['request_date_to'] ?? null,
    'purpose_visit' => $validatedData['purpose_visit'] ?? null,
    'purpose_detail' => $validatedData['purpose_detail'] ?? null,
    'building' => $validatedData['building'] ?? null,
    'level' => $validatedData['level'] ?? null,
    'specific_location' => $validatedData['specific_location'] ?? null,
    'pic_name' => $validatedData['pic_name'] ?? null,
    'pic_contact' => $validatedData['pic_contact'] ?? null,
    'car_plate_no' => $validatedData['car_plate_no'] ?? null,
    'vehicle_type' => $validatedData['vehicle_type'] ?? null,
    'name_1' => $validatedData['name_1'] ?? null,
    'id_card_1' => $validatedData['id_card_1'] ?? null,
    'name_2' => $validatedData['name_2'] ?? null,
    'id_card_2' => $validatedData['id_card_2'] ?? null,
    'name_3' => $validatedData['name_3'] ?? null,
    'id_card_3' => $validatedData['id_card_3'] ?? null,
    'name_4' => $validatedData['name_4'] ?? null,
    'id_card_4' => $validatedData['id_card_4'] ?? null,
    'name_5' => $validatedData['name_5'] ?? null,
    'id_card_5' => $validatedData['id_card_5'] ?? null,
    'name_6' => $validatedData['name_6'] ?? null,
    'id_card_6' => $validatedData['id_card_6'] ?? null,
    'name_7' => $validatedData['name_7'] ?? null,
    'id_card_7' => $validatedData['id_card_7'] ?? null,
    'name_8' => $validatedData['name_8'] ?? null,
    'id_card_8' => $validatedData['id_card_8'] ?? null,
    'name_9' => $validatedData['name_9'] ?? null,
    'id_card_9' => $validatedData['id_card_9'] ?? null,
    'name_10' => $validatedData['name_10'] ?? null,
    'id_card_10' => $validatedData['id_card_10'] ?? null,
    'name_11' => $validatedData['name_11'] ?? null,
    'id_card_11' => $validatedData['id_card_11'] ?? null,
    'name_12' => $validatedData['name_12'] ?? null,
    'id_card_12' => $validatedData['id_card_12'] ?? null,
    'name_13' => $validatedData['name_13'] ?? null,
    'id_card_13' => $validatedData['id_card_13'] ?? null,
    'name_14' => $validatedData['name_14'] ?? null,
    'id_card_14' => $validatedData['id_card_14'] ?? null,
    'name_15' => $validatedData['name_15'] ?? null,
    'id_card_15' => $validatedData['id_card_15'] ?? null,
    'name_16' => $validatedData['name_16'] ?? null,
    'id_card_16' => $validatedData['id_card_16'] ?? null,
    'name_17' => $validatedData['name_17'] ?? null,
    'id_card_17' => $validatedData['id_card_17'] ?? null,
    'name_18' => $validatedData['name_18'] ?? null,
    'id_card_18' => $validatedData['id_card_18'] ?? null,
    'name_19' => $validatedData['name_19'] ?? null,
    'id_card_19' => $validatedData['id_card_19'] ?? null,
    'name_20' => $validatedData['name_20'] ?? null,
    'id_card_20' => $validatedData['id_card_20'] ?? null,
    'name_21' => $validatedData['name_21'] ?? null,
    'id_card_21' => $validatedData['id_card_21'] ?? null,
    'name_22' => $validatedData['name_22'] ?? null,
    'id_card_22' => $validatedData['id_card_22'] ?? null,
    'name_23' => $validatedData['name_23'] ?? null,
    'id_card_23' => $validatedData['id_card_23'] ?? null,
    'name_24' => $validatedData['name_24'] ?? null,
    'id_card_24' => $validatedData['id_card_24'] ?? null,
    'name_25' => $validatedData['name_25'] ?? null,
    'id_card_25' => $validatedData['id_card_25'] ?? null,
    'name_26' => $validatedData['name_26'] ?? null,
    'id_card_26' => $validatedData['id_card_26'] ?? null,
    'name_27' => $validatedData['name_27'] ?? null,
    'id_card_27' => $validatedData['id_card_27'] ?? null,
    'name_28' => $validatedData['name_28'] ?? null,
    'id_card_28' => $validatedData['id_card_28'] ?? null,
    'name_29' => $validatedData['name_29'] ?? null,
    'id_card_29' => $validatedData['id_card_29'] ?? null,
    'name_30' => $validatedData['name_30'] ?? null,
    'id_card_30' => $validatedData['id_card_30'] ?? null,
    'material_1' => $validatedData['material_1'] ?? null,
    'quantity_1' => $validatedData['quantity_1'] ?? null,
    'material_2' => $validatedData['material_2'] ?? null,
    'quantity_2' => $validatedData['quantity_2'] ?? null,
    'material_3' => $validatedData['material_3'] ?? null,
    'quantity_3' => $validatedData['quantity_3'] ?? null,
    'material_4' => $validatedData['material_4'] ?? null,
    'quantity_4' => $validatedData['quantity_4'] ?? null,
    'material_5' => $validatedData['material_5'] ?? null,
    'quantity_5' => $validatedData['quantity_5'] ?? null,
    'material_6' => $validatedData['material_6'] ?? null,
    'quantity_6' => $validatedData['quantity_6'] ?? null,
    'material_7' => $validatedData['material_7'] ?? null,
    'quantity_7' => $validatedData['quantity_7'] ?? null,
    'material_8' => $validatedData['material_8'] ?? null,
    'quantity_8' => $validatedData['quantity_8'] ?? null,
    'material_9' => $validatedData['material_9'] ?? null,
    'quantity_9' => $validatedData['quantity_9'] ?? null,
    'material_10' => $validatedData['material_10'] ?? null,
    'quantity_10' => $validatedData['quantity_10'] ?? null,
    'material_11' => $validatedData['material_11'] ?? null,
    'quantity_11' => $validatedData['quantity_11'] ?? null,
    'material_12' => $validatedData['material_12'] ?? null,
    'quantity_12' => $validatedData['quantity_12'] ?? null,
    'material_13' => $validatedData['material_13'] ?? null,
    'quantity_13' => $validatedData['quantity_13'] ?? null,
    'material_14' => $validatedData['material_14'] ?? null,
    'quantity_14' => $validatedData['quantity_14'] ?? null,
    'material_15' => $validatedData['material_15'] ?? null,
    'quantity_15' => $validatedData['quantity_15'] ?? null,
    'material_16' => $validatedData['material_16'] ?? null,
    'quantity_16' => $validatedData['quantity_16'] ?? null,
    'material_17' => $validatedData['material_17'] ?? null,
    'quantity_17' => $validatedData['quantity_17'] ?? null,
    'material_18' => $validatedData['material_18'] ?? null,
    'quantity_18' => $validatedData['quantity_18'] ?? null,
    'material_19' => $validatedData['material_19'] ?? null,
    'quantity_19' => $validatedData['quantity_19'] ?? null,
    'material_20' => $validatedData['material_20'] ?? null,
    'quantity_20' => $validatedData['quantity_20'] ?? null,
    'material_21' => $validatedData['material_21'] ?? null,
    'quantity_21' => $validatedData['quantity_21'] ?? null,
    'material_22' => $validatedData['material_22'] ?? null,
    'quantity_22' => $validatedData['quantity_22'] ?? null,
    'material_23' => $validatedData['material_23'] ?? null,
    'quantity_23' => $validatedData['quantity_23'] ?? null,
    'material_24' => $validatedData['material_24'] ?? null,
    'quantity_24' => $validatedData['quantity_24'] ?? null,
    'material_25' => $validatedData['material_25'] ?? null,
    'quantity_25' => $validatedData['quantity_25'] ?? null,
    'material_26' => $validatedData['material_26'] ?? null,
    'quantity_26' => $validatedData['quantity_26'] ?? null,
    'material_27' => $validatedData['material_27'] ?? null,
    'quantity_27' => $validatedData['quantity_27'] ?? null,
    'material_28' => $validatedData['material_28'] ?? null,
    'quantity_28' => $validatedData['quantity_28'] ?? null,
    'material_29' => $validatedData['material_29'] ?? null,
    'quantity_29' => $validatedData['quantity_29'] ?? null,
    'material_30' => $validatedData['material_30'] ?? null,
    'quantity_30' => $validatedData['quantity_30'] ?? null,
    'upload_id_card_foto' => $fileCard ?? null,
    'status' => 'Pending',

]);

  Mail::to($visitor->email)->send(new \App\Mail\VisitorForm($visitor));

  Vehicle::create([
                'name' => $validatedData['pic_name'] ?? null,
                'number_plate' => $validatedData['car_plate_no'] ?? null,
                'type' => $validatedData['vehicle_type'] ?? null,
                'company' => $validatedData['company_name'] ?? null,
                'date_from' => $validatedData['request_date_from'] ?? null,
                'date_to' => $validatedData['request_date_to'] ?? null,
                'id_visitor' => $visitor->id_visitor ?? null,
                'status' => 'Active',
            ]);

      Histori::create([
             'id_data' => $visitor->id_visitor ?? null,
             'id_akun' => Auth::user()->id ?? null,
             'type' => "Visitor",
             'judul' => "New Permit Request",
            'text' => "Visitor permit from " . $visitor->pic_name ?? null,
            ]);



        // Return a success response with data
        return redirect()->route('index_approve')->with('success', 'Visitor permit request submitted successfully!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Handle validation errors
        $errors = $e->validator->errors();
        Log::error('Validation Errors:', $errors->all());
        return back()->withErrors($errors)->withInput();

    } catch (\Exception $e) {
        // Log the exception error
        Log::error('Error submitting visitor permit request', ['error' => $e->getMessage()]);
        return back()->with('error', 'There was an error submitting the form. Please try again.');
    }
}

}
