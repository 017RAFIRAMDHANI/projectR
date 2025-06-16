<?php

namespace App\Http\Controllers;

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



        $spreadsheetId2 = '1R95TSACrTB2t1v2trYnew6aiXeHdqEDDqB4emlNjQ1M';  // Spreadsheet ID
        $range2 = 'Form Responses 1!A:AZ';  // Range data di Google Sheets (kolom A hingga Z)

        $response2 = $service->spreadsheets_values->get($spreadsheetId2, $range2);
        $values2 = $response2->getValues();


  foreach ($values2 as $key2 => $row2) {
            if ($key2 == 0) continue;  // Skip header row

    $primary_number2 = isset($row2[51]) ? $row2[51] : null;

            // Validasi apakah primary_number2 sudah ada di database
            $visitor = Visitor::where('primary_number', $primary_number2)->first();

              if (!$visitor) {

            $visitor = Visitor::create([
    'email' => isset($row2[1]) ? $row2[1] : null,
    'request_date_from' => isset($row2[2]) ? $row2[2] : null,
    'request_date_to' => isset($row2[3]) ? $row2[3] : null,
    'purpose' => isset($row2[4]) ? $row2[4] : null,
    'purpose_detail' => isset($row2[5]) ? $row2[5] : null,
    'area' => isset($row2[6]) ? $row2[6] : null,
    'name_1' => isset($row2[7]) ? $row2[7] : null,
    'id_card_1' => isset($row2[8]) ? $row2[8] : null,
    'name_2' => isset($row2[9]) ? $row2[9] : null,
    'id_card_2' => isset($row2[10]) ? $row2[10] : null,
    'name_3' => isset($row2[11]) ? $row2[11] : null,
    'id_card_3' => isset($row2[12]) ? $row2[12] : null,
    'name_4' => isset($row2[13]) ? $row2[13] : null,
    'id_card_4' => isset($row2[14]) ? $row2[14] : null,
    'name_5' => isset($row2[15]) ? $row2[15] : null,
    'id_card_5' => isset($row2[16]) ? $row2[16] : null,
    'name_6' => isset($row2[17]) ? $row2[17] : null,
    'id_card_6' => isset($row2[18]) ? $row2[18] : null,
    'name_7' => isset($row2[19]) ? $row2[19] : null,
    'id_card_7' => isset($row2[20]) ? $row2[20] : null,
    'name_8' => isset($row2[21]) ? $row2[21] : null,
    'id_card_8' => isset($row2[22]) ? $row2[22] : null,
    'name_9' => isset($row2[23]) ? $row2[23] : null,
    'id_card_9' => isset($row2[24]) ? $row2[24] : null,
    'name_10' => isset($row2[25]) ? $row2[25] : null,
    'id_card_10' => isset($row2[26]) ? $row2[26] : null,
    'qty_1' => isset($row2[27]) ? $row2[27] : null,
    'material_1' => isset($row2[28]) ? $row2[28] : null,
    'qty_2' => isset($row2[29]) ? $row2[29] : null,
    'material_2' => isset($row2[30]) ? $row2[30] : null,
    'qty_3' => isset($row2[31]) ? $row2[31] : null,
    'material_3' => isset($row2[32]) ? $row2[32] : null,
    'qty_4' => isset($row2[33]) ? $row2[33] : null,
    'material_4' => isset($row2[34]) ? $row2[34] : null,
    'qty_5' => isset($row2[35]) ? $row2[35] : null,
    'material_5' => isset($row2[36]) ? $row2[36] : null,
    'qty_6' => isset($row2[37]) ? $row2[37] : null,
    'material_6' => isset($row2[38]) ? $row2[38] : null,
    'qty_7' => isset($row2[39]) ? $row2[39] : null,
    'material_7' => isset($row2[40]) ? $row2[40] : null,
    'qty_8' => isset($row2[41]) ? $row2[41] : null,
    'material_8' => isset($row2[42]) ? $row2[42] : null,
    'qty_9' => isset($row2[43]) ? $row2[43] : null,
    'material_9' => isset($row2[44]) ? $row2[44] : null,
    'qty_10' => isset($row2[45]) ? $row2[45] : null,
    'material_10' => isset($row2[46]) ? $row2[46] : null,
    'pic_name' => isset($row2[47]) ? $row2[47] : null,
    'contact_number' => isset($row2[48]) ? $row2[48] : null,
    'car_plate_no' => isset($row2[49]) ? $row2[49] : null,
    'vehicle_type' => isset($row2[50]) ? $row2[50] : null,
    'primary_number' => $primary_number2,
    'permit_number' => isset($row2[52]) ? $row2[52] : null,
    'status' => 'Pending', // Default false (pending)
    'mode' => 'Normal'
]);

            $id_visitor = $visitor->id_visitor;


            Vendor_Visitor::create([
                  'id_visitor' => $id_visitor,
                  'type' => 'Visitor',
                  'mode' => 'Normal',

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


Vendor_Visitor::create([
    'id_vendor' => $id_vendor,
    'type' => 'Vendor',
    'mode' => 'Normal',

]);
}
            }

        }

    }


