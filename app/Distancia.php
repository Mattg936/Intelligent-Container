<?php

namespace contenedor;

use Illuminate\Database\Eloquent\Model;

class Distancia extends Model
{
    protected $table='distancia';

    protected $primaryKey='id';

    public $timestamps=false;


    protected $fillable =[
    	'chipid',
    	'fecha',
    	'distancia',
        'estado',
       ];

    protected $guarded=[
    
    ];

    
}
