<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Models\Pagina;
use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        Pagina::contarPagina(\request()->path());
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:App\Models\Usuario,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nombre' => ['required', 'string', 'max:50', 'min:3'],
            'telefono' => ['required', 'string', 'max:10', 'min:8'],
            'direccion' => ['required', 'string', 'max:100', 'min:3'],
            'ci' => ['required', 'string'],
        ]);

        $user = null;

        try {
            DB::beginTransaction();


            $user = Usuario::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nombre' => $request->nombre,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
            ])->assignRole('cliente');

            Cliente::create([
                'id' => $user->id,
                'ci' => $request->ci,
            ]);

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            return back();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
