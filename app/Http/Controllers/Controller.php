<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Vendor_Visitor;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Google_Client;
use Google_Service_Sheets;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

       public function __construct()
    {
        $this->fetchVendorData(); // Menambahkan fungsi untuk memanggil data setiap kali controller dipanggil
        $this->fetchVisitorData(); // Menambahkan fungsi untuk memanggil data setiap kali controller dipanggil
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

        $spreadsheetId = '1dak8fWnKPc58hTm5QAxLmqr92L3vBW4WQLRKDEL_L20';  // Spreadsheet ID
        $range = 'Form Responses 1!A:BD';  // Range data di Google Sheets (kolom A hingga Z)

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

;        // Proses data setiap baris
        foreach ($values as $key => $row) {
            if ($key == 0) continue;  // Skip header row


            // Ambil primary_number yang sudah ada di Google Sheets (asumsi kolom 10 untuk primary_number)
            $primary_number = isset($row[55]) ? $row[55] : null;

            // Validasi apakah primary_number sudah ada di database
            $vendor = Vendor::where('primary_number', $primary_number)->first();

         //  $startDate = isset($row[21]) ? Carbon::createFromFormat('d/m/Y', $row[21])->format('Y-m-d') : null;  // Column V
        //   $endDate = isset($row[22]) ? Carbon::createFromFormat('d/m/Y', $row[22])->format('Y-m-d') : null;  // Column W
            if (!$vendor) {
             $vendor = Vendor::create([
  'email' => isset($row[1]) ? $row[1] : null,
    'validity_date_from' => isset($row[2]) ? Carbon::createFromFormat('d/m/Y', $row[2])->format('Y-m-d') : null,
    'validity_date_to' => isset($row[3]) ? Carbon::createFromFormat('d/m/Y', $row[3])->format('Y-m-d') : null,
    'validity_time_from' => isset($row[4]) ? $row[4] : null,
    'validity_time_to' => isset($row[5]) ? $row[5] : null,
    'company_name' => isset($row[6]) ? $row[6] : null,
    'requestor_name' => isset($row[7]) ? $row[7] : null,
    'company_contact' => isset($row[8]) ? $row[8] : null,
    'phone_number' => isset($row[9]) ? $row[9] : null,
    'location_of_work' => isset($row[10]) ? $row[10] : null,
    'building_level_room' => isset($row[11]) ? $row[11] : null,
    'purpose' => isset($row[12]) ? $row[12] : null,
    'purpose_details' => isset($row[13]) ? $row[13] : null,
    'total_worker' => isset($row[14]) ? $row[14] : null,
    'worker1_name' => isset($row[15]) ? $row[15] : null,
    'worker1_id_card' => isset($row[16]) ? $row[16] : null,
    'worker1_birthdate' => isset($row[17]) ? Carbon::createFromFormat('d/m/Y', $row[17])->format('Y-m-d') : null,
    'worker2_name' => isset($row[18]) ? $row[18] : null,
    'worker2_id_card' => isset($row[19]) ? $row[19] : null,
    'worker2_birthdate' => isset($row[20]) ? Carbon::createFromFormat('d/m/Y', $row[20])->format('Y-m-d') : null,
    'worker3_name' => isset($row[21]) ? $row[21] : null,
    'worker3_id_card' => isset($row[22]) ? $row[22] : null,
    'worker3_birthdate' => isset($row[23]) ? Carbon::createFromFormat('d/m/Y', $row[23])->format('Y-m-d') : null,
    'worker4_name' => isset($row[24]) ? $row[24] : null,
    'worker4_id_card' => isset($row[25]) ? $row[25] : null,
    'worker4_birthdate' => isset($row[26]) ? Carbon::createFromFormat('d/m/Y', $row[26])->format('Y-m-d') : null,
    'worker5_name' => isset($row[27]) ? $row[27] : null,
    'worker5_id_card' => isset($row[28]) ? $row[28] : null,
    'worker5_birthdate' => isset($row[29]) ? Carbon::createFromFormat('d/m/Y', $row[29])->format('Y-m-d') : null,
    'worker6_name' => isset($row[30]) ? $row[30] : null,
    'worker6_id_card' => isset($row[31]) ? $row[31] : null,
    'worker6_birthdate' => isset($row[32]) ? Carbon::createFromFormat('d/m/Y', $row[32])->format('Y-m-d') : null,
    'worker7_name' => isset($row[33]) ? $row[33] : null,
    'worker7_id_card' => isset($row[34]) ? $row[34] : null,
    'worker7_birthdate' => isset($row[35]) ? Carbon::createFromFormat('d/m/Y', $row[35])->format('Y-m-d') : null,
    'worker8_name' => isset($row[36]) ? $row[36] : null,
    'worker8_id_card' => isset($row[37]) ? $row[37] : null,
    'worker8_birthdate' => isset($row[38]) ? Carbon::createFromFormat('d/m/Y', $row[38])->format('Y-m-d') : null,
    'worker9_name' => isset($row[39]) ? $row[39] : null,
    'worker9_id_card' => isset($row[40]) ? $row[40] : null,
    'worker9_birthdate' => isset($row[41]) ? Carbon::createFromFormat('d/m/Y', $row[41])->format('Y-m-d') : null,
    'worker10_name' => isset($row[42]) ? $row[42] : null,
    'worker10_id_card' => isset($row[43]) ? $row[43] : null,
    'worker10_birthdate' => isset($row[44]) ? Carbon::createFromFormat('d/m/Y', $row[44])->format('Y-m-d') : null,
    'generate_dust' => isset($row[45]) ? $row[45] : null,
    'state_cause' => isset($row[46]) ? $row[46] : null,
    'method' => isset($row[47]) ? $row[47] : null,
    'any_fire' => isset($row[48]) ? $row[48] : null,
    'isolation_of' => isset($row[49]) ? $row[49] : null,
    'isolation_name' => isset($row[50]) ? $row[50] : null,
    'isolation_date' => isset($row[51]) ?  $row[51] : null,
    'file_mos' => isset($row[52]) ? $row[52] : null,
    'number_plate' => isset($row[53]) ? $row[53] : null,
    'vehicle_types' => isset($row[54]) ? $row[54] : null,
    'primary_number' => $primary_number,

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

        }}


