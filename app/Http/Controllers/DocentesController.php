<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Client\Request;
use App\Http\Controllers\Controller;

class DocentesController extends Controller
{
    public function validar($user)
    {
       $user_db = Docente::all();
       dd($user_db);
       exit();
       if ($user_db->isEmpty())
       {
        $res = ["estado" => false, "user" => []];
        return response()->json($res);
       }
       $res = ["estado" => true, "user" => $user_db];
       return response()->json($res, 200);
    }

    public function validarUser(Request $request)
    {
        return response()->json([
            "mensaje" => $request->input('nombre')
        ]);
    //    $user_db = Usuario::where('user', $user)->get();

    //    if ($user_db->isEmpty())
    //    {
    //     $res = ["estado" => false, "user" => []];
    //     return response()->json($res);
    //    }
    //    $res = ["estado" => true, "user" => $user_db];
    //    return response()->json($res, 200);
    }
}