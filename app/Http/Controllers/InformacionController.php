<?php

namespace contenedor\Http\Controllers;

use Illuminate\Http\Request;

use contenedor\Http\Requests;
use contenedor\Distancia;
use contenedor\Informacion;
use Illuminate\Support\Facades\Redirect;

use contenedor\Http\Requests\InformacionFormRequest;
use contenedor\Http\Requests\DistanciaFormRequest;
use DB;

class InformacionController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request){
    	if ($request)
    	{
    		
    		return view('main.Informacion.index');
    	}
    }
      
}
