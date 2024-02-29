<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = $request->get('erro');
        if($erro == 1){
            $erro = 'Usuário ou Senha não existe';
        }

        if($erro == 2){
            $erro = 'Necessário realizar login para ter acesso a página';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request)
    {
        //regras de valdiação
        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        //mensagens de feedback de validação
        $feedback = [
            'usuario.email' => 'O campo usuário (e-mail) é obrigatório',
            'senha.required' => 'O campo senha é obrigatório'
        ];

        $request->validate($regras, $feedback);

        //recupera valores do formulario
        $email = $request->get('usuario');
        $password = $request->get('senha');

        //iniciar o model do users
        $user = new User();

        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();
        
        if(!isset($usuario->name)){
            return redirect()->route('site.login', ['erro' => 1]);
        }

        session_start();
        $_SESSION['nome'] = $usuario->name;
        $_SESSION['email'] = $usuario->email;
        
        return redirect()->route('app.home');
    }

    public function sair()
    {
        session_destroy();
        return redirect()->route('site.index');
    }
}
