<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function auth(Request $request){
        $credenciais = $request->validate([
            'user' => ['required'],
            'password' => ['required'],
        ],[
            'user.required' => 'O campo usuário é obrigatório!',
            'password.required' => 'O campo senha é obrigatório!',
        ]);
        if(Auth::attempt($credenciais)){
            $request->session()->regenerate();
            return redirect()->intended('home');
        }
        else{
            return redirect()->back()->with('error', 'Usuário ou senha inválida');
        }
    }
    
}
