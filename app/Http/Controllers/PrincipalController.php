<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MotivoContato;
class PrincipalController extends Controller
{
    public function principal(){
        $motivoContatos = $motivoContatos = MotivoContato::all();
        return view('site.principal', ['motivo_contatos' => $motivoContatos]);
    }
}
