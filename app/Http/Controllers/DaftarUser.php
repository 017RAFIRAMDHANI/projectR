<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DaftarUser extends Controller
{
      public function store(Request $request)
    {
        // Validasi data yang dimasukkan
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'item1' => 'required|string|max:255',
            'item2' => 'required|string|max:255',
            'userType' => 'required',
        ]);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'item1' => $validated['item1'],
            'item2' => $validated['item2'],
            'role' => $validated['userType'],
            'remember_token' => Str::random(60),
        ]);


        // Arahkan ke halaman manajemen pengguna setelah berhasil menambah
        return redirect()->route('regisuser')->with('success', 'Pengguna baru berhasil ditambahkan');
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
    public function destroy($id)
{
    dd($id);
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
        'access_employe_delete',
        'access_employe_view',
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
