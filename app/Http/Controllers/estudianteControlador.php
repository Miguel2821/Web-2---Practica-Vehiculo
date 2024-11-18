<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\estudiante;
use Illuminate\Support\Facades\Validator;


class estudianteControlador extends Controller
{
    // 
    public function index()
    {
        $estudiante = estudiante::all();

        if ($estudiante->isEmpty()){
            return response()->json(['message' => 'No hay esudiantes registrados'],200);
        };

        return response()->json($estudiante, 200);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'nombre'=> 'required',
            'correo'=> 'required|email|unique:estudiante',
            'contrasena'=> 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $estudiante = estudiante::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contrasena' => $request->contrasena
        ]);

        if (!$estudiante) {
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'estudiante' => $estudiante,
            'status' => 201
        ];

        return response()->json($data, 201);

    }

    public function show($id)
    {
        $estudiante = estudiante::find($id);

        if (!$estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'estudiante' => $estudiante,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $estudiante = estudiante::find($id);

        if (!$estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $estudiante->delete();

        $data = [
            'message' => 'Estudiante eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $estudiante = estudiante::find($id);

        if (!$estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'correo' => 'required|email|unique:estudiante',
            'contrasena' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $estudiante->nombre = $request->nombre;
        $estudiante->correo = $request->correo;
        $estudiante->contrasena = $request->contrasena;
        $estudiante->save();

        $data = [
            'message' => 'Estudiante actualizado',
            'estudiante' => $estudiante,
            'status' => 200
        ];

        return response()->json($data, 200);

    }


    public function updatePartial(Request $request, $id)
    {
        $estudiante = estudiante::find($id);

        if (!$estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'max:255',
            'correo' => 'email|unique:estudiante',
            'contrasena' => ''
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre')) {
            $estudiante->nombre = $request->nombre;
        }

        if ($request->has('correo')) {
            $estudiante->correo = $request->correo;
        }

        if ($request->has('contrasena')) {
            $estudiante->contrasena = $request->contrasena;
        }
        
        $estudiante->save();

        $data = [
            'message' => 'Estudiante actualizado',
            'estudiante' => $estudiante,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

}
