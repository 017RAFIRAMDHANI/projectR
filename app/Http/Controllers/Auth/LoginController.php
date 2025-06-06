<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

  protected function authenticated(Request $request, $user)
    {
        // Cek role pengguna dan arahkan sesuai dengan role mereka
        switch ($user->role) {
            case 'Vendor':
            case 'Visitor':
                // Jika role Vendor atau Visitor, arahkan ke '/'
                return redirect('/');

            case 'DHI':
                // Jika role DHI, arahkan ke /dhi-dashboard
                return redirect('/dhi-dashboard');

            case 'FM':
                // Jika role FH, arahkan ke /fh-dashboard
                return redirect('/fm-dashboard');

            case 'Client':
                // Jika role Client, arahkan ke /client-dashboard
                return redirect('/client-dashboard');

            default:
                // Jika tidak ada role yang cocok, arahkan ke route default
                return redirect('/');
        }
    }
}
