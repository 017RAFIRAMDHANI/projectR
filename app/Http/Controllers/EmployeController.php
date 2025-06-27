<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Safeti;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeController extends Controller
{
    //
       public function __construct()
    {
        $this->middleware('auth');


    }
public function index(Request $request)
{
    // Mendapatkan input searchFilter dari request
    $searchFilter = $request->input('searchFilter');
    $statusFilter = $request->input('statusFilter');

    // Membuat query untuk Employee
    $employe = Employe::query();

    // Jika ada input searchFilter, terapkan filter pencarian
    if ($searchFilter) {
        $employe = $employe->where(function($query) use ($searchFilter) {
            $query->where('name', 'like', '%' . $searchFilter . '%')
                ->orWhere('company_name', 'like', '%' . $searchFilter . '%')
                ->orWhere('position', 'like', '%' . $searchFilter . '%')
                ->orWhere('type', 'like', '%' . $searchFilter . '%')
                ->orWhere('number_plate', 'like', '%' . $searchFilter . '%')
                ->orWhere('status', 'like', '%' . $searchFilter . '%');
        });
    }
    if ($statusFilter) {
        $employe = $employe->where(function($query) use ($statusFilter) {
            $query->where('status', 'like', '%' . $statusFilter . '%');

        });
    }

    // Lakukan paginasi setelah filter diterapkan
    $employe = $employe->paginate(1);

    // Mengirimkan data ke view
    return view('employee-data', [
        "dataEmploye" => $employe
    ]);
}


    public function store(Request $request){
     //   dd($request->all());
         try {
        // Validasi input data
        $validatedData = $request->validate([
            'number_plate' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'type2' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
            'file_card' => 'required|file|max:5048',
        ]);
    // Mendapatkan file yang diupload
        $file = $request->file('file_card');
        $originalFileName = $file->getClientOriginalName();  // Nama asli file

        // Menyimpan file ke storage/app/public
        $filePath = $file->storeAs('employee_files', $originalFileName);

        // Membuat data Employee berdasarkan data yang sudah divalidasi
        $employee = Employe::create([
            'number_plate' => $validatedData['number_plate'],
            'type' => $validatedData['type'],
            'type2' => $validatedData['type2'],
            'name' => $validatedData['name'],
            'company_name' => $validatedData['company_name'],
            'position' => $validatedData['position'],
            'type2' => $validatedData['type2'],
            'file_card' => $filePath,  // Simpan path file
            'status' => $validatedData['status'],
        ]);


       Vehicle::create([
                'name' => $validatedData['name'] ?? null,
                'number_plate' => $validatedData['number_plate'] ?? null,
                'type' => $validatedData['type'] ?? null,
                'company' => $validatedData['company_name'] ?? null,
                'date_from' => "-",
                'date_to' => "-",
                'id_employe' => $employee->id_employe ?? null,
                'status' => 'Active',
            ]);

        Safeti::create([
                    'id_employe' => $employee->id_employe ?? null,
                    'status_safeti' => 'Inactive',
                    'type' => 'Employee',
                    'company_name' => $validatedData['company_name'] ?? null,
                    'name' => $validatedData['name'] ?? null,
            ]);

        return redirect()->back()->with('success', 'Employee created successfully!');
    } catch (\Exception $e) {
        // Menangani error jika terjadi pengecualian
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
    }
    public function update(Request $request)
{

    try {
        // Validasi input data
        $validatedData = $request->validate([
            'number_plate' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'type2' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
            'file_card' => 'nullable|file|max:5048',  // Nullable for updating without a new file
        ]);

        // Mencari employee yang ingin diupdate
        $employee = Employe::findOrFail($request->id_employe);

        // Jika file baru diupload
        if ($request->hasFile('file_card')) {
                // Hapus file lama jika ada
    if ($employee->file_card && Storage::exists($employee->file_card)) {
        Storage::delete($employee->file_card);
    }
            // Mendapatkan file yang diupload
            $file = $request->file('file_card');
            $originalFileName = $file->getClientOriginalName();  // Nama asli file

            // Menyimpan file ke storage/app/public
            $filePath = $file->storeAs('employee_files', $originalFileName);

            // Update path file
            $employee->file_card = $filePath;
        }

        // Update data employee
        $employee->name = $validatedData['name'];
        $employee->company_name = $validatedData['company_name'];
        $employee->position = $validatedData['position'];
        $employee->type2 = $validatedData['type2'];
        $employee->number_plate = $validatedData['number_plate'];
        $employee->type = $validatedData['type'];
        $employee->status = $validatedData['status'];

        // Simpan perubahan
        $employee->save();

        return redirect()->back()->with('success', 'Employee updated successfully!');
    } catch (\Exception $e) {
        // Menangani error jika terjadi pengecualian
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
}

public function delete(Request $request)
{

    try {
        // Find and delete the employee
        $employee = Employe::findOrFail($request->id_employe);

        $employee->delete();

        return redirect()->back()->with('success', 'Employee deleted successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error deleting employee: ' . $e->getMessage());
    }
}

}
