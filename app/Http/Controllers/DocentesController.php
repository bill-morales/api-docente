<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class DocentesController extends Controller
{
    public function listar()
    {
        $user_db = Docente::all();
        if ($user_db->isEmpty()) {
            $res = ["estado" => false, "user" => []];
            return response()->json($res);
        }
        $res = ["estado" => true, "user" => $user_db];
        return response()->json($res, 200);
    }

    public function Guardar(Request $request)
    {
        if ($request->isJson()) {

            // creando usuadio con els ervicio de auth, enviandole una peticion post
            $endpoint = "http://localhost:5000/api/guardar";
            $mi_request = new RequestController($endpoint);
            $datos = [
                "user" => $request->json("dni"),
                "password" => "2022" . $request->json("dni")
            ];

            $response = json_decode($mi_request->post($datos));
            // si el usuario no se creó correctamente con el servicio auth, retirnamos un error
            if (!$response->estado) {
                return response()->json($response);
            }

            $user = new Docente();
            $user->nombres = $request->json("nombres");
            $user->apellidos = $request->json("apellidos");
            $user->dni = $request->json("dni");
            $user->id_usuario = $response->user->id;

            if ($user->save()) {

                return response()->json([
                    "estado" => true,
                    "msg" => "Docente creado correctamente",
                    "msg 2" => $response
                ]);
            }

            return response()->json([
                "estado" => false,
                "msg" => "No se pudo crear al usuario"
            ]);
        }
    }

    public function docenteByIdUsuario($user_id)
    {
        try {
            $docente = Docente::where('id_usuario', $user_id)->first();
            if (!$docente)
            {
                $res = ["estado" => false, "user" => []];
                return response()->json($res);
            }
            $res = ["estado" => true, "user" => $docente];
            return response()->json($res, 200);
    
        } catch (Exception $e) {
            return response()->json([
                "estaso" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }
}
