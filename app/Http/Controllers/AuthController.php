<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request){
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'O nome de usuário é obrigatório.',
                'password.required' => 'A senha é obrigatória.'
            ]
        );
        $username = $request->get('username');
        //Desconsiderando senha pois é um prototipo
        //$password = $request->get('password');

        $user = Usuario::where('login', $username)->where('deleted_at', null)->first();

        if(!$user){
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Credenciais inválidas');
        }
        session([
            'user' => [
                'login' => $user->login,
                'cargo' => $user->cargo
            ]
        ]);

        echo 'Login feito com sucesso';
    }

    public function logout(){
        session()->forget('user');
        return redirect()->to('login');
    }
}
