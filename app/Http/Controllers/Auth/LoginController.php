<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        // Intenta autenticar al usuario utilizando las credenciales proporcionadas
        // y verifica si el usuario está activo antes de permitir el inicio de sesión.
        return $this->guard()->attempt(
            $this->credentials($request) + ['activo' => true], // Agrega la condición de usuario activo
            $request->filled('remember')
        );
    }

    protected function authenticated(Request $request, $user)
    {
        if (!$user->activo) {
            Auth::logout(); // Cierra la sesión del usuario inactivo
            return redirect()->route('login')
                ->with('error', 'Tu cuenta está desactivada.');
        }

        return redirect()->intended($this->redirectPath());
    }
}
