<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Articles;
use DB;
use Carbon\Carbon;


class ArticlesController extends Controller
{
    
    public function index(Request $request){
        $vista="articles";
        return view('articles.index')->with("vista",$vista);  
    }
  
    public function autocomplete(Request $request)
    {
      
        $term = strtoupper($request->input("term"));
        $sql = "SELECT id,codigo,descripcion,valor from public.articles 
        where (codigo like '%$term%' or descripcion like upper('%$term%')) limit 5";
        $articulo = DB::Select($sql);
        $response = array();

        foreach($articulo as $filas){
               
            $response[] = array("id" => $filas->id,
                                "codigo"           => $filas->codigo,
                                "label"            => $filas->codigo." ".utf8_encode($filas->descripcion),
                                "value"            => $filas->descripcion,
                                "descripcion"      => $filas->descripcion,
                                "valor_formateado" => number_format($filas->valor,0,'','.'),
                                "valor"            => $filas->valor,
                                "anulado"          => 'NO'
                               );
        }

        return json_encode($response);

    }

}