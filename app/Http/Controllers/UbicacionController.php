<?php

namespace contenedor\Http\Controllers;

use Illuminate\Http\Request;

use contenedor\Http\Requests;

class UbicacionController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request){
    	if ($request)
    	{
    		
    		return view('main.Ubicacion.index');
    	}
    }
}
