<?php

namespace App\Http\Controllers;

use App\Models\Histori;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
          public function __construct()
    {
        $this->middleware('auth');


    }
     public function delete(Request $request)
{
    // Menampilkan data yang diterima untuk debugging


    try {
        // Mencari kendaraan berdasarkan id_vehicle
        $vehicle = Vehicle::find($request->id_vehicle);

        // Jika kendaraan tidak ditemukan, kembalikan pesan error
        if (!$vehicle) {
            return redirect()->route('vehicle-list')->with('error', 'Vehicle not found!');
        }

        // Menghapus data kendaraan
        $vehicle->delete();

                 Histori::create([
    'id_data' => $vehicle->id_vehicle ?? null,
    'id_akun' => Auth::user()->id ?? null,
    'type' => "Vehicle",
    'judul' => "Delete Vehicle",
    'text' => ($vehicle->type ? $vehicle->type : 'Unknown Type') . " successfully delete with plate number " . ($vehicle->number_plate ? $vehicle->number_plate : 'Unknown Plate'),
]);

        // Setelah berhasil dihapus, redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Vehicle deleted successfully!');
    } catch (\Exception $e) {
        // Menangani error dan mengembalikan pesan error
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
}

       public function index(Request $request){
          $searchVehicle =  $request->input('searchVehicle');
          $selectType =  $request->input('selectType');
          $fromDate =  $request->input('fromDate');
          $toDate =  $request->input('toDate');

        $vehicle = Vehicle::query();

          if($searchVehicle){

        $vehicle = $vehicle->where(function($query) use ($searchVehicle) {
            $query->where('name', 'like', '%' . $searchVehicle . '%')
                ->orWhere('number_plate', 'like', '%' . $searchVehicle . '%')
                ->orWhere('type', 'like', '%' . $searchVehicle . '%')
                ->orWhere('company', 'like', '%' . $searchVehicle . '%')
                ->orWhere('date_from', 'like', '%' . $searchVehicle . '%')
                ->orWhere('date_to', 'like', '%' . $searchVehicle . '%')
                ->orWhere('status', 'like', '%' . $searchVehicle . '%');
        });

          }
          if($selectType){

        $vehicle = $vehicle->where(function($query) use ($selectType) {
            $query->where('type', 'like', '%' . $selectType . '%');

        });

          }
          if($fromDate){

        $vehicle = $vehicle->where(function($query) use ($fromDate) {
            $query->where('date_from', 'like', '%' . $fromDate . '%');

        });

          }
          if($toDate){

        $vehicle = $vehicle->where(function($query) use ($toDate) {
            $query->where('date_to', 'like', '%' . $toDate . '%');

        });

          }
   $vehicle = $vehicle->paginate(20);

          return view('vehicle-list',[
            "dataVehicle" => $vehicle
          ]);
    }
         public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'number_plate' => 'required|string|max:255',
            'type' => 'required|string',
            'company' => 'required|string|max:255',
            'date_from' => 'required|date|before_or_equal:date_to',
            'date_to' => 'required|date|after_or_equal:date_from',
            'status' => 'required|string|in:Active,Inactive',
        ]);

        try {
            // Menyimpan data dengan cara eksplisit
           $vehi =  Vehicle::create([
                'name' => $validatedData['name'],
                'number_plate' => $validatedData['number_plate'],
                'type' => $validatedData['type'],
                'company' => $validatedData['company'],
                'date_from' => $validatedData['date_from'],
                'date_to' => $validatedData['date_to'],
                'status' => $validatedData['status'],
            ]);


       Histori::create([
    'id_data' => $vehi->id_vehicle ?? null,
    'id_akun' => Auth::user()->id ?? null,
    'type' => "Vehicle",
    'judul' => "New Vehicle added",
    'text' => "New " . ($vehi->type ? $vehi->type : 'Unknown Type') . " successfully added with plate number " . ($vehi->number_plate ? $vehi->number_plate : 'Unknown Plate'),
]);



            // Mengarahkan ke halaman daftar kendaraan atau halaman lain sesuai kebutuhan
            return redirect()->route('vehicle-list')->with('success', 'Vehicle added successfully!');
        } catch (Exception $e) {
            // Menangani error jika ada kesalahan saat penyimpanan
            return redirect()->back()->with('error', 'Failed to add vehicle: ' . $e->getMessage());
        }
    }

   public function update(Request $request)
{
    try {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'number_plate' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'company' => 'required|string|max:255',
        'date_from' => 'required|date|before_or_equal:date_to',
            'date_to' => 'required|date|after_or_equal:date_from',
            'status' => 'required|string|in:Active,Inactive',
        ]);

        // Cari kendaraan berdasarkan id_vehicle
        $vehicle = Vehicle::find($request->id_vehicle);

        // Jika kendaraan tidak ditemukan, throw exception
        if (!$vehicle) {
            throw new \Exception('Vehicle not found!');
        }

        // Update data kendaraan
        $vehicle->name = $validatedData['name'];
        $vehicle->number_plate = $validatedData['number_plate'];
        $vehicle->type = $validatedData['type'];
        $vehicle->company = $validatedData['company'];
        $vehicle->date_from = $validatedData['date_from'];
        $vehicle->date_to = $validatedData['date_to'];
        $vehicle->status = $validatedData['status'];

        // Simpan perubahan ke database
        $vehicle->save();

              Histori::create([
    'id_data' => $vehicle->id_vehicle ?? null,
    'id_akun' => Auth::user()->id ?? null,
    'type' => "Vehicle",
    'judul' => "Edit Vehicle",
    'text' => ($vehicle->type ? $vehicle->type : 'Unknown Type') . " successfully update with plate number " . ($vehicle->number_plate ? $vehicle->number_plate : 'Unknown Plate'),
]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Vehicle updated successfully!');

    } catch (\Exception $e) {
        // Menangani error jika terjadi pengecualian
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
}

}
