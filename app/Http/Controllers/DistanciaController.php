<?php

namespace contenedor\Http\Controllers;

use Illuminate\Http\Request;

use contenedor\Http\Requests;
use contenedor\Distancia;
use Illuminate\Support\Facades\Redirect;
use contenedor\Http\Requests\DistanciaFormRequest;
use DB;

class DistanciaController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request){
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$distancias=DB::table('distancia')->where('chipid','LIKE','%'.$query.'%')
    		->orderBy('id','desc')
    		->paginate(5);
    		return view('main.distancia.index',["distancias"=>$distancias,"searchText"=>$query]);
    	}
    }
    public function create(){
    	return view("main.distancia.create");
    }
    public function store(DistanciaFormRequest $request){
    	$distancia=new Distancia;
    	$distancia->chipid=$request->get('chipid');
    	$distancia->fecha=$request->get('fecha');
    	$distancia->distancia=$request->get('distancia');
        $distancia->estado=$request->get('estado');
        $distancia->save();
    	return Redirect::to('main/distancia');
    }
    public function show($id){
    	return view("main.distancia.show",["distancia"=>Distancia::findOrFail($id)]);
    }
    public function edit($id){
    	return view("main.distancia.edit",["distancia"=>Distancia::findOrFail($id)]);
    }
    public function update(DistanciaFormRequest $request,$id){
    	$distancia=Distancia::findOrFail($id);
    	$distancia->chipid=$request->get('chipid');
    	$distancia->fecha=$request->get('fecha');
    	$distancia->distancia=$request->get('descripcion');
        $distancia->estado=$request->get('estado');
    	$distancia->update();
    	return Redirect::to('main/distancia');

    }
    public function destroy(){
    	return Redirect::to('main/distancia');
    
    }
}
