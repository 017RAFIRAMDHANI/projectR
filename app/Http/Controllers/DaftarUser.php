<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class DaftarUser extends Controller
{
          public function __construct()
    {
        $this->middleware('auth');


    }
 public function store(Request $request)
{

    // Validasi data yang dimasukkan
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8|confirmed',

        'userType' => 'required',
    ]);

    // Menentukan role berdasarkan input user
    $role = $validated['userType'];

    // Inisialisasi array untuk permissions
    $permissions = [
        'access_newspecial_create' => 0,
        'access_employe_create' => 0,
        'access_employe_edit' => 0,
        'access_employe_delete' => 0,
        'access_employe_view' => 0,
        'access_approvals_view' => 0,
        'access_approvals_edit' => 0,
        'access_visvin_view' => 0,
        'access_visvin_delete' => 0,
        'access_vehicle_view' => 0,
        'access_vehicle_create' => 0,
        'access_vehicle_edit' => 0,
        'access_vehicle_delete' => 0,
        'access_safety_view' => 0,
        'access_safety_edit' => 0,
        'access_report_view' => 0,
        'access_report_create' => 0,
        'access_report_edit' => 0,
        'access_report_delete' => 0,
        'access_role_view' => 0,
        'access_role_create' => 0,
        'access_role_edit' => 0,
        'access_role_delete' => 0,
    ];

    // Menentukan permissions dan item1, item2 berdasarkan role
    if ($role == 'FM') {
        // Set semua akses ke 1 untuk FM
        $permissions['access_newspecial_create'] = 1;
        $permissions['access_employe_create'] = 1;
        $permissions['access_employe_edit'] = 1;
        $permissions['access_employe_delete'] = 1;
        $permissions['access_employe_view'] = 1;
        $permissions['access_approvals_view'] = 1;
        $permissions['access_approvals_edit'] = 1;
        $permissions['access_visvin_view'] = 1;
        $permissions['access_visvin_delete'] = 1;
        $permissions['access_vehicle_view'] = 1;
        $permissions['access_vehicle_create'] = 1;
        $permissions['access_vehicle_edit'] = 1;
        $permissions['access_vehicle_delete'] = 1;
        $permissions['access_safety_view'] = 1;
        $permissions['access_safety_edit'] = 1;
        $permissions['access_report_view'] = 1;
        $permissions['access_report_create'] = 1;


    } elseif ($role == 'DHI') {
        // Set akses tambahan untuk DHI
        $permissions['access_newspecial_create'] = 1;
        $permissions['access_employe_create'] = 1;
        $permissions['access_employe_edit'] = 1;
        $permissions['access_employe_delete'] = 1;
        $permissions['access_employe_view'] = 1;
        $permissions['access_approvals_view'] = 1;
        $permissions['access_approvals_edit'] = 1;
        $permissions['access_visvin_view'] = 1;
        $permissions['access_visvin_delete'] = 1;
        $permissions['access_vehicle_view'] = 1;
        $permissions['access_vehicle_create'] = 1;
        $permissions['access_vehicle_edit'] = 1;
        $permissions['access_vehicle_delete'] = 1;
        $permissions['access_safety_view'] = 1;
        $permissions['access_safety_edit'] = 1;
        $permissions['access_report_view'] = 1;
        $permissions['access_report_create'] = 1;
        $permissions['access_report_edit'] = 1;
        $permissions['access_report_delete'] = 1;
        $permissions['access_role_view'] = 1;
        $permissions['access_role_create'] = 1;
        $permissions['access_role_edit'] = 1;
        $permissions['access_role_delete'] = 1;


    } elseif ($role == 'Client') {
        // Set akses terbatas untuk Client
        $permissions['access_employe_view'] = 1;
        $permissions['access_visvin_view'] = 1;
        $permissions['access_vehicle_view'] = 1;
        $permissions['access_vehicle_create'] = 1;
        $permissions['access_vehicle_edit'] = 1;
        $permissions['access_vehicle_delete'] = 1;
        $permissions['access_safety_view'] = 1;
        $permissions['access_safety_edit'] = 1;
        $permissions['access_report_view'] = 1;
        $permissions['access_report_create'] = 1;


    }

    // Membuat pengguna baru dan menyimpan permissions
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'item1' => $request->item1 ?? null,
        'item2' => $request->item2 ?? null,
        'item3' => $request->item3 ?? null,
        'item4' => $request->item4 ?? null,
        'item5' => $request->item5 ?? null,
        'item6' => $request->item6 ?? null,

        'role' => $role,

        'access_newspecial_create' => $permissions['access_newspecial_create'],
        'access_employe_create' => $permissions['access_employe_create'],
        'access_employe_edit' => $permissions['access_employe_edit'],
        'access_employe_delete' => $permissions['access_employe_delete'],
        'access_employe_view' => $permissions['access_employe_view'],
        'access_approvals_view' => $permissions['access_approvals_view'],
        'access_approvals_edit' => $permissions['access_approvals_edit'],
        'access_visvin_view' => $permissions['access_visvin_view'],
        'access_visvin_delete' => $permissions['access_visvin_delete'],
        'access_vehicle_view' => $permissions['access_vehicle_view'],
        'access_vehicle_create' => $permissions['access_vehicle_create'],
        'access_vehicle_edit' => $permissions['access_vehicle_edit'],
        'access_vehicle_delete' => $permissions['access_vehicle_delete'],
        'access_safety_view' => $permissions['access_safety_view'],
        'access_safety_edit' => $permissions['access_safety_edit'],
        'access_report_view' => $permissions['access_report_view'],
        'access_report_create' => $permissions['access_report_create'],
        'access_report_edit' => $permissions['access_report_edit'],
        'access_report_delete' => $permissions['access_report_delete'],
        'access_role_view' => $permissions['access_role_view'],
        'access_role_create' => $permissions['access_role_create'],
        'access_role_edit' => $permissions['access_role_edit'],
        'access_role_delete' => $permissions['access_role_delete'],
        'remember_token' => Str::random(60),
    ]);

    // Arahkan ke halaman manajemen pengguna setelah berhasil menambah
    return redirect()->route('regisuser')->with('success', 'New user added successfully');
}



    // Halaman form untuk menambah user baru
    public function create()
    {
        return view('regisuser');
    }
    public function index()
    {
        $dataUser = User::paginate(20);
        return view('user-list',[
            "dataUser" => $dataUser
        ]);
    }
    public function profile($id)
    {
        $dataUser = User::where('id',$id)->first();
        return view('profile',[
            "dataUser" => $dataUser
        ]);
    }
    public function edit_profile(Request $request,$id)
    {

        try {
        // Validasi
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',

            'file_card' => 'nullable|file'
        ]);

        // Ambil user yang akan diupdate
        $user = User::findOrFail($id);

        // Update field biasa
        $user->name = $validate['name'];
        $user->email = $validate['email'];


        // Cek apakah ada file yang diupload
       if ($request->hasFile('file_card')) {

    // Hapus file lama jika ada
    if ($user->file_card && Storage::exists($user->file_card)) {
        Storage::delete($user->file_card);
    }

    $file = $request->file('file_card');
    $originalFileName = $file->getClientOriginalName();

    $file->storeAs('users/', $originalFileName);

    // Simpan path lengkap ke database
    $user->file_card = 'users/'.$originalFileName;
}


        $user->save();

        return redirect()->back()->with('success', 'Data updated successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update data: ' . $e->getMessage());
    }
    }
    public function destroy($id)
{
    $dataUser = User::where('id',$id)->delete();
    if($dataUser){
          return back()->with('success', 'User successfully deleted');
    }
}
    public function permision($id)
{
     $dataUser = User::where('id',$id)->first();
        return view('role-management',[
            "dataUser" => $dataUser
        ]);
}
    public function update(Request $request,$id)
{
    $dataUser = User::findOrFail($id);

    // Daftar nama-nama field yang akan diproses
    $permissions = [
        'access_newspecial_create',
        'access_employe_create',
        'access_employe_edit',
        'access_employe_view',
        'access_employe_delete',
        'access_approvals_view',
        'access_approvals_edit',
        'access_visvin_view',
        'access_visvin_delete',
        'access_vehicle_view',
        'access_vehicle_create',
        'access_vehicle_edit',
        'access_vehicle_delete',
        'access_safety_view',
        'access_safety_edit',
        'access_report_view',
        'access_report_create',
        'access_report_edit',
        'access_report_delete',
        'access_role_view',
        'access_role_create',
        'access_role_edit',
        'access_role_delete',
    ];

    // Loop untuk memeriksa apakah checkbox dicentang dan set nilai 1 jika dicentang
    foreach ($permissions as $permission) {
        if ($request->has($permission) && $request->$permission == 'on') {
            $dataUser->$permission = 1;
        } else {
            $dataUser->$permission = null;
        }
    }

    // Simpan perubahan
    $dataUser->save();

    // Redirect atau beri response
  return back()->with('success', 'User updated successfully!');

}
}
