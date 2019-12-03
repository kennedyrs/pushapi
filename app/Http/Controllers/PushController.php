<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PushController extends Controller
{
	public function send(Request $request)
	{
		
		$resposta = notificationOneSignal($request->playid, $request->titulo, $request->mensagem);
		$retorno = json_decode($resposta, true);
		
		return $retorno['id'];
	}

}
