<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\NovaSenhaRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        $tipo = Auth::user()->tipo;
        if ($tipo == "U") {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            return redirect()->intended(RouteServiceProvider::DASHBOARD);
        }
    }

    public function alterarSenha()
    {
        $usuario = Auth::user();

        return view('auth.change-password', ['usuario' => $usuario]);
    }

    public function mudarSenha(NovaSenhaRequest $request)
    {
        $usuario =  Auth::user();

        $antiga = $request->senhaantiga;
        //  $antiga = Hash::make($antiga);
        // return $antiga;

        //verifica se a seha é igual a atual
        if (!Hash::check($antiga,  $usuario->password)) {
            return redirect()->back()->with("error", "A senha digitada não é igual sua senha atual.");
        }

        // Quando a senha antiga for igual a do bd e quando a nova senha for diferente da senha atual cai aqui
        if (Hash::check($antiga,  $usuario->password) && !strcmp($antiga, $request->password) == 0) {
            $usuario->password = bcrypt($request->password);
            $usuario->save();

            if ($usuario->tipo == "U") {
                return redirect()->intended(RouteServiceProvider::HOME)->with("success", "Senha alterada com sucesso");;
            } else {
                return redirect()->intended(RouteServiceProvider::DASHBOARD)->with("success", "Senha alterada com sucesso");;
            }
        }

        // Quando a nova senha for igual a anterior vai dar este aviso
        if (strcmp($antiga, $request->password) == 0) {
            return redirect()->back()->with("error", "A nova senha não pode ser igual a anterior.");
        }

        return "não";
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
