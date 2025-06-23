<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Vendor;
use App\Models\Vendor_Visitor;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Sheets;
use Illuminate\Support\Facades\Log;

class DataMasuk extends Controller
{
         public function __construct()
    {

      $this->fetchVendorData();
       $this->fetchVisitorData();

    }
    public function index(Request $request){

    }

      public function fetchVisitorData(){
   $client = new Google_Client();
        $client->setAuthConfig(config('google.credentials_path'));
        $client->addScope(Google_Service_Sheets::SPREADSHEETS_READONLY);

        $service = new Google_Service_Sheets($client);



        $spreadsheetId2 = '1c6B_07BZBJSfH70g086FgecFM9GQ9cvjsonL2oxNNF8';  // Spreadsheet ID
        $range2 = 'Form Responses 1!A:EF';  // Range data di Google Sheets (kolom A hingga Z)

        $response2 = $service->spreadsheets_values->get($spreadsheetId2, $range2);
        $values2 = $response2->getValues();
       // dd($values2);

  foreach ($values2 as $key2 => $row2) {
            if ($key2 == 0) continue;  // Skip header row

    $primary_number2 = isset($row2[134]) ? $row2[134] : null;

            // Validasi apakah primary_number2 sudah ada di database
            $visitor = Visitor::where('primary_number', $primary_number2)->first();
          $request_date_from = isset($row2[2]) ? Carbon::createFromFormat('d/m/Y', $row2[2])->format('Y-m-d') : null;  // Column validity_date_from
           $request_date_to = isset($row2[3]) ? Carbon::createFromFormat('d/m/Y', $row2[3])->format('Y-m-d') : null;  // Column validity_date_from

              if (!$visitor) {

          $visitor = Visitor::create([
    'email' => isset($row2[1]) ? $row2[1] : null,
    'request_date_from' => $request_date_from,
    'request_date_to' => $request_date_to,
    'purpose_visit' => isset($row2[4]) ? $row2[4] : null,
    'purpose_detail' => isset($row2[5]) ? $row2[5] : null,
    'building' => isset($row2[6]) ? $row2[6] : null,
    'level' => isset($row2[7]) ? $row2[7] : null,
    'specific_location' => isset($row2[8]) ? $row2[8] : null,
    'pic_name' => isset($row2[9]) ? $row2[9] : null,
    'pic_contact' => isset($row2[10]) ? $row2[10] : null,
    'car_plate_no' => isset($row2[11]) ? $row2[11] : null,
    'vehicle_type' => isset($row2[12]) ? $row2[12] : null,
    'name_1' => isset($row2[13]) ? $row2[13] : null,
    'id_card_1' => isset($row2[14]) ? $row2[14] : null,
    'name_2' => isset($row2[15]) ? $row2[15] : null,
    'id_card_2' => isset($row2[16]) ? $row2[16] : null,
    'name_3' => isset($row2[17]) ? $row2[17] : null,
    'id_card_3' => isset($row2[18]) ? $row2[18] : null,
    'name_4' => isset($row2[19]) ? $row2[19] : null,
    'id_card_4' => isset($row2[20]) ? $row2[20] : null,
    'name_5' => isset($row2[21]) ? $row2[21] : null,
    'id_card_5' => isset($row2[22]) ? $row2[22] : null,
    'name_6' => isset($row2[23]) ? $row2[23] : null,
    'id_card_6' => isset($row2[24]) ? $row2[24] : null,
    'name_7' => isset($row2[25]) ? $row2[25] : null,
    'id_card_7' => isset($row2[26]) ? $row2[26] : null,
    'name_8' => isset($row2[27]) ? $row2[27] : null,
    'id_card_8' => isset($row2[28]) ? $row2[28] : null,
    'name_9' => isset($row2[29]) ? $row2[29] : null,
    'id_card_9' => isset($row2[30]) ? $row2[30] : null,
    'name_10' => isset($row2[31]) ? $row2[31] : null,
    'id_card_10' => isset($row2[32]) ? $row2[32] : null,
    'name_11' => isset($row2[33]) ? $row2[33] : null,
    'id_card_11' => isset($row2[34]) ? $row2[34] : null,
    'name_12' => isset($row2[35]) ? $row2[35] : null,
    'id_card_12' => isset($row2[36]) ? $row2[36] : null,
    'name_13' => isset($row2[37]) ? $row2[37] : null,
    'id_card_13' => isset($row2[38]) ? $row2[38] : null,
    'name_14' => isset($row2[39]) ? $row2[39] : null,
    'id_card_14' => isset($row2[40]) ? $row2[40] : null,
    'name_15' => isset($row2[41]) ? $row2[41] : null,
    'id_card_15' => isset($row2[42]) ? $row2[42] : null,
    'name_16' => isset($row2[43]) ? $row2[43] : null,
    'id_card_16' => isset($row2[44]) ? $row2[44] : null,
    'name_17' => isset($row2[45]) ? $row2[45] : null,
    'id_card_17' => isset($row2[46]) ? $row2[46] : null,
    'name_18' => isset($row2[47]) ? $row2[47] : null,
    'id_card_18' => isset($row2[48]) ? $row2[48] : null,
    'name_19' => isset($row2[49]) ? $row2[49] : null,
    'id_card_19' => isset($row2[50]) ? $row2[50] : null,
    'name_20' => isset($row2[51]) ? $row2[51] : null,
    'id_card_20' => isset($row2[52]) ? $row2[52] : null,
    'name_21' => isset($row2[53]) ? $row2[53] : null,
    'id_card_21' => isset($row2[54]) ? $row2[54] : null,
    'name_22' => isset($row2[55]) ? $row2[55] : null,
    'id_card_22' => isset($row2[56]) ? $row2[56] : null,
    'name_23' => isset($row2[57]) ? $row2[57] : null,
    'id_card_23' => isset($row2[58]) ? $row2[58] : null,
    'name_24' => isset($row2[59]) ? $row2[59] : null,
    'id_card_24' => isset($row2[60]) ? $row2[60] : null,
    'name_25' => isset($row2[61]) ? $row2[61] : null,
    'id_card_25' => isset($row2[62]) ? $row2[62] : null,
    'name_26' => isset($row2[63]) ? $row2[63] : null,
    'id_card_26' => isset($row2[64]) ? $row2[64] : null,
    'name_27' => isset($row2[65]) ? $row2[65] : null,
    'id_card_27' => isset($row2[66]) ? $row2[66] : null,
    'name_28' => isset($row2[67]) ? $row2[67] : null,
    'id_card_28' => isset($row2[68]) ? $row2[68] : null,
    'name_29' => isset($row2[69]) ? $row2[69] : null,
    'id_card_29' => isset($row2[70]) ? $row2[70] : null,
    'name_30' => isset($row2[71]) ? $row2[71] : null,
    'id_card_30' => isset($row2[72]) ? $row2[72] : null,
    'material_1' => isset($row2[73]) ? $row2[73] : null,
    'quantity_1' => isset($row2[74]) ? $row2[74] : null,
    'material_2' => isset($row2[75]) ? $row2[75] : null,
    'quantity_2' => isset($row2[76]) ? $row2[76] : null,
    'material_3' => isset($row2[77]) ? $row2[77] : null,
    'quantity_3' => isset($row2[78]) ? $row2[78] : null,
    'material_4' => isset($row2[79]) ? $row2[79] : null,
    'quantity_4' => isset($row2[80]) ? $row2[80] : null,
    'material_5' => isset($row2[81]) ? $row2[81] : null,
    'quantity_5' => isset($row2[82]) ? $row2[82] : null,
    'material_6' => isset($row2[83]) ? $row2[83] : null,
    'quantity_6' => isset($row2[84]) ? $row2[84] : null,
    'material_7' => isset($row2[85]) ? $row2[85] : null,
    'quantity_7' => isset($row2[86]) ? $row2[86] : null,
    'material_8' => isset($row2[87]) ? $row2[87] : null,
    'quantity_8' => isset($row2[88]) ? $row2[88] : null,
    'material_9' => isset($row2[89]) ? $row2[89] : null,
    'quantity_9' => isset($row2[90]) ? $row2[90] : null,
    'material_10' => isset($row2[91]) ? $row2[91] : null,
    'quantity_10' => isset($row2[92]) ? $row2[92] : null,
    'material_11' => isset($row2[93]) ? $row2[93] : null,
    'quantity_11' => isset($row2[94]) ? $row2[94] : null,
    'material_12' => isset($row2[95]) ? $row2[95] : null,
    'quantity_12' => isset($row2[96]) ? $row2[96] : null,
    'material_13' => isset($row2[97]) ? $row2[97] : null,
    'quantity_13' => isset($row2[98]) ? $row2[98] : null,
    'material_14' => isset($row2[99]) ? $row2[99] : null,
    'quantity_14' => isset($row2[100]) ? $row2[100] : null,
    'material_15' => isset($row2[101]) ? $row2[101] : null,
    'quantity_15' => isset($row2[102]) ? $row2[102] : null,
    'material_16' => isset($row2[103]) ? $row2[103] : null,
    'quantity_16' => isset($row2[104]) ? $row2[104] : null,
    'material_17' => isset($row2[105]) ? $row2[105] : null,
    'quantity_17' => isset($row2[106]) ? $row2[106] : null,
    'material_18' => isset($row2[107]) ? $row2[107] : null,
    'quantity_18' => isset($row2[108]) ? $row2[108] : null,
    'material_19' => isset($row2[109]) ? $row2[109] : null,
    'quantity_19' => isset($row2[110]) ? $row2[110] : null,
    'material_20' => isset($row2[111]) ? $row2[111] : null,
    'quantity_20' => isset($row2[112]) ? $row2[112] : null,
    'material_21' => isset($row2[113]) ? $row2[113] : null,
    'quantity_21' => isset($row2[114]) ? $row2[114] : null,
    'material_22' => isset($row2[115]) ? $row2[115] : null,
    'quantity_22' => isset($row2[116]) ? $row2[116] : null,
    'material_23' => isset($row2[117]) ? $row2[117] : null,
    'quantity_23' => isset($row2[118]) ? $row2[118] : null,
    'material_24' => isset($row2[119]) ? $row2[119] : null,
    'quantity_24' => isset($row2[120]) ? $row2[120] : null,
    'material_25' => isset($row2[121]) ? $row2[121] : null,
    'quantity_25' => isset($row2[122]) ? $row2[122] : null,
    'material_26' => isset($row2[123]) ? $row2[123] : null,
    'quantity_26' => isset($row2[124]) ? $row2[124] : null,
    'material_27' => isset($row2[125]) ? $row2[125] : null,
    'quantity_27' => isset($row2[126]) ? $row2[126] : null,
    'material_28' => isset($row2[127]) ? $row2[127] : null,
    'quantity_28' => isset($row2[128]) ? $row2[128] : null,
    'material_29' => isset($row2[129]) ? $row2[129] : null,
    'quantity_29' => isset($row2[130]) ? $row2[130] : null,
    'material_30' => isset($row2[131]) ? $row2[131] : null,
    'quantity_30' => isset($row2[132]) ? $row2[132] : null,
    'upload_id_card_foto' => isset($row2[133]) ? $row2[133] : null,
    'primary_number' => $primary_number2 ?? null,
    'company_name' => isset($row2[135]) ? $row2[135] : null,
    'status' =>  'Pending', // Default value for status

]);

            $id_visitor = $visitor->id_visitor;

$pic_name = $visitor->pic_name;
$car_plate_no = $visitor->car_plate_no;
$vehicle_type = $visitor->vehicle_type;
$company_name = $visitor->company_name;
$request_date_from = $visitor->request_date_from;
$request_date_to = $visitor->request_date_to;

  Vehicle::create([
                'name' => $pic_name ?? null,
                'number_plate' => $car_plate_no ?? null,
                'type' => $vehicle_type ?? null,
                'company' => $company_name ?? null,
                'date_from' => $request_date_from ?? null,
                'date_to' => $request_date_to ?? null,
                'id_visitor' => $id_visitor ?? null,
                'status' => 'Active',
            ]);


 }
  }


    }
    public function fetchVendorData()
    {
        $client = new Google_Client();
        $client->setAuthConfig(config('google.credentials_path'));
        $client->addScope(Google_Service_Sheets::SPREADSHEETS_READONLY);

        $service = new Google_Service_Sheets($client);

        $spreadsheetId = '1Ra4aL3f8oi-HcIFduL69IlePauKVd6v6BeihJ9AcC-c';  // Spreadsheet ID
        $range = 'Form Responses 1!A:CD';  // Range data di Google Sheets (kolom A hingga Z)

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

;        // Proses data setiap baris
        foreach ($values as $key => $row) {
            if ($key == 0) continue;  // Skip header row


            // Ambil primary_number yang sudah ada di Google Sheets (asumsi kolom 10 untuk primary_number)
            $primary_number = isset($row[81]) ? $row[81] : null;

            // Validasi apakah primary_number sudah ada di database
            $vendor = Vendor::where('primary_number', $primary_number)->first();

           $validity_date_from = isset($row[6]) ? Carbon::createFromFormat('d/m/Y', $row[6])->format('Y-m-d') : null;  // Column validity_date_from
           $validity_date_to = isset($row[7]) ? Carbon::createFromFormat('d/m/Y', $row[7])->format('Y-m-d') : null;  // Column validity_date_from

            if (!$vendor) {
          $vendor = Vendor::create([
    'email' => isset($row[1]) ? $row[1] : null,
    'company_name' => isset($row[2]) ? $row[2] : null,
    'company_contact' => isset($row[3]) ? $row[3] : null,
    'requestor_name' => isset($row[4]) ? $row[4] : null,
    'phone_number' => isset($row[5]) ? $row[5] : null,
    'validity_date_from' => $validity_date_from ? $validity_date_from : null,
    'validity_date_to' => $validity_date_to ? $validity_date_to : null,
    'work_description' => isset($row[8]) ? $row[8] : null,
    'building' => isset($row[9]) ? $row[9] : null,
    'level' => isset($row[10]) ? $row[10] : null,
    'specific_location' => isset($row[11]) ? $row[11] : null,
    'vehicle_types' => isset($row[12]) ? $row[12] : null,
    'number_plate' => isset($row[13]) ? $row[13] : null,
    'worker1_name' => isset($row[14]) ? $row[14] : null,
    'worker1_id_card' => isset($row[15]) ? $row[15] : null,
    'worker2_name' => isset($row[16]) ? $row[16] : null,
    'worker2_id_card' => isset($row[17]) ? $row[17] : null,
    'worker3_name' => isset($row[18]) ? $row[18] : null,
    'worker3_id_card' => isset($row[19]) ? $row[19] : null,
    'worker4_name' => isset($row[20]) ? $row[20] : null,
    'worker4_id_card' => isset($row[21]) ? $row[21] : null,
    'worker5_name' => isset($row[22]) ? $row[22] : null,
    'worker5_id_card' => isset($row[23]) ? $row[23] : null,
    'worker6_name' => isset($row[24]) ? $row[24] : null,
    'worker6_id_card' => isset($row[25]) ? $row[25] : null,
    'worker7_name' => isset($row[26]) ? $row[26] : null,
    'worker7_id_card' => isset($row[27]) ? $row[27] : null,
    'worker8_name' => isset($row[28]) ? $row[28] : null,
    'worker8_id_card' => isset($row[29]) ? $row[29] : null,
    'worker9_name' => isset($row[30]) ? $row[30] : null,
    'worker9_id_card' => isset($row[31]) ? $row[31] : null,
    'worker10_name' => isset($row[32]) ? $row[32] : null,
    'worker10_id_card' => isset($row[33]) ? $row[33] : null,
    'worker11_name' => isset($row[34]) ? $row[34] : null,
    'worker11_id_card' => isset($row[35]) ? $row[35] : null,
    'worker12_name' => isset($row[36]) ? $row[36] : null,
    'worker12_id_card' => isset($row[37]) ? $row[37] : null,
    'worker13_name' => isset($row[38]) ? $row[38] : null,
    'worker13_id_card' => isset($row[39]) ? $row[39] : null,
    'worker14_name' => isset($row[40]) ? $row[40] : null,
    'worker14_id_card' => isset($row[41]) ? $row[41] : null,
    'worker15_name' => isset($row[42]) ? $row[42] : null,
    'worker15_id_card' => isset($row[43]) ? $row[43] : null,
    'worker16_name' => isset($row[44]) ? $row[44] : null,
    'worker16_id_card' => isset($row[45]) ? $row[45] : null,
    'worker17_name' => isset($row[46]) ? $row[46] : null,
    'worker17_id_card' => isset($row[47]) ? $row[47] : null,
    'worker18_name' => isset($row[48]) ? $row[48] : null,
    'worker18_id_card' => isset($row[49]) ? $row[49] : null,
    'worker19_name' => isset($row[50]) ? $row[50] : null,
    'worker19_id_card' => isset($row[51]) ? $row[51] : null,
    'worker20_name' => isset($row[52]) ? $row[52] : null,
    'worker20_id_card' => isset($row[53]) ? $row[53] : null,
    'worker21_name' => isset($row[54]) ? $row[54] : null,
    'worker21_id_card' => isset($row[55]) ? $row[55] : null,
    'worker22_name' => isset($row[56]) ? $row[56] : null,
    'worker22_id_card' => isset($row[57]) ? $row[57] : null,
    'worker23_name' => isset($row[58]) ? $row[58] : null,
    'worker23_id_card' => isset($row[59]) ? $row[59] : null,
    'worker24_name' => isset($row[60]) ? $row[60] : null,
    'worker24_id_card' => isset($row[61]) ? $row[61] : null,
    'worker25_name' => isset($row[62]) ? $row[62] : null,
    'worker25_id_card' => isset($row[63]) ? $row[63] : null,
    'worker26_name' => isset($row[64]) ? $row[64] : null,
    'worker26_id_card' => isset($row[65]) ? $row[65] : null,
    'worker27_name' => isset($row[66]) ? $row[66] : null,
    'worker27_id_card' => isset($row[67]) ? $row[67] : null,
    'worker28_name' => isset($row[68]) ? $row[68] : null,
    'worker28_id_card' => isset($row[69]) ? $row[69] : null,
    'worker29_name' => isset($row[70]) ? $row[70] : null,
    'worker29_id_card' => isset($row[71]) ? $row[71] : null,
    'worker30_name' => isset($row[72]) ? $row[72] : null,
    'worker30_id_card' => isset($row[73]) ? $row[73] : null,
    'generate_dust' => isset($row[74]) ? $row[74] : null,
    'fire_system' => isset($row[75]) ? $row[75] : null,
    'isolation_of' => isset($row[76]) ? $row[76] : null,
    'isolation_name' => isset($row[77]) ? $row[77] : null,
    'isolation_date' => isset($row[78]) ? $row[78] : null,
    'up_id_card_foto' => isset($row[79]) ? $row[79] : null,
    'file_mos' => isset($row[80]) ? $row[80] : null,
    'primary_number' => isset($row[81]) ? $row[81] : null,
    'check_one_approve' => isset($row[82]) ? $row[82] : null,
    'status' => 'Pending',
    'mode' => 'Normal',
]);




$id_vendor = $vendor->id_vendor;
$requestor_name = $vendor->requestor_name;
$number_plate = $vendor->number_plate;
$vehicle_types = $vendor->vehicle_types;
$company_name = $vendor->company_name;
$validity_date_from = $vendor->validity_date_from;
$validity_date_to = $vendor->validity_date_to;

  Vehicle::create([
                'name' => $requestor_name ?? null,
                'number_plate' => $number_plate ?? null,
                'type' => $vehicle_types ?? null,
                'company' => $company_name ?? null,
                'date_from' => $validity_date_from ?? null,
                'date_to' => $validity_date_to ?? null,
                'id_vendor' => $id_vendor ?? null,
                'status' => 'Active',
            ]);

}
            }

        }

    }


