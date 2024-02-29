<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;
class ContatoController extends Controller
{
    public function contato(Request $request){

        $motivoContatos = MotivoContato::all();
        return view('site.contato', ['titulo' => 'Contato', 'motivo_contatos' => $motivoContatos]);
    }

    public function salvar(Request $request){

        $request->validate(
            [
                'nome' => 'required|min:3|max:40|unique:site_contatos',
                'telefone' => 'required',
                'email' => 'email',
                'motivo_contatos_id' => 'required',
                'mensagem' => 'required|max:2000'
            ],
            [
                'nome.required' => 'O campo nome precisa ser preenchido',
                'nome.min' => 'O campo nome precisa ter no minimo 3 caracteres',
                'nome.max' => 'O campo nome precisa ter no máximo 40 caracteres',
                'nome.unique' => 'O nome informado ja está em uso',
                'email.email' => 'O campo email precisa ser preenchido corretamente',
                'motivo_contatos_id.required' => 'O campo motivo contato precisa ser preenchido',
                'mensagem.max' => 'O campo mensagem deve ter no máximo 2000 caracteres',

                'required' => 'O campo :attribute precisa ser preenchido'
            ]
        );
        
        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
