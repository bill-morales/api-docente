<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocentesController extends Controller
{
    public function listar()
    {
       $user_db = Docente::all();
       if ($user_db->isEmpty())
       {
        $res = ["estado" => false, "user" => []];
        return response()->json($res);
       }
       $res = ["estado" => true, "user" => $user_db];
       return response()->json($res, 200);
    }

    public function Guardar(Request $request)
    {   
         if ($request->isJson())
        {
            $user = new Docente();
            $user->nombres = $request->json("nombres");
            $user->apellidos = $request->json("apellidos");
            $user->dni = $request->json("dni");

            if ($user->save())
            {
                return response()->json([
                    "estado" => true,
                    "msg" => "Usuario creado correctamente"
                ]);
            }
            return response()->json([
                "estado" => false,
                "msg" => "No se pudo crear al usuario"
            ]);
        }
    }

    public function actualizar(Request $request,$docente){
        if($request->isJson()){
          var_dump($docente);
        }
    }
}