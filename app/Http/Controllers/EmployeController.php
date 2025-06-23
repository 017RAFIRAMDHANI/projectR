<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    //
       public function __construct()
    {
        $this->middleware('auth');


    }
    public function index(){
        $dataEmploye = Employe::paginate(20);
        return view('employee-data',[
            "dataEmploye" => $dataEmploye
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
