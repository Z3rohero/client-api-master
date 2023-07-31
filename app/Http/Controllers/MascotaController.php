<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las mascotas y retornarlas como una respuesta JSON
        $mascotas = Mascota::all();
        return response()->json($mascotas, 200);
    }

    public function store(Request $request)
    {

        try{
             // Validar los datos recibidos en la solicitud
        $request->validate([
            'nombre' => 'required|string|max:100',
            'raza' => 'required|string|max:100',
            'Sexo' => 'string|max:20',
            'Codigo_cliente' => 'required|integer|exists:clientes,id'
        ]);


        $mascota = new Mascota;
        $mascota->nombre = $request->nombre;
        $mascota->raza = $request->raza;
        $mascota->Sexo = $request->Sexo;
        $mascota->Codigo_cliente = $request->Codigo_cliente;
        $mascota->save();

        
        // Retornar la mascota recién creada como respuesta en formato JSON
        return response()->json($mascota, 201);

        }catch (\Exception $e){
            return response()->json(['error' => 'Error al crear la mascota '. $e], 500);

        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mascota  $mascota
     * @return \Illuminate\Http\Response
     */
    public function show(Mascota $mascota)
    {
        // Retornar la mascota especificada en la solicitud como respuesta en formato JSON
        return response()->json($mascota, 200);
    }

    public function update(Request $request, Mascota $mascota)
    {
        try{
            // Validar los datos recibidos en la solicitud
        $request->validate([
            'nombre' => 'string|max:100',
            'raza' => ' string|max:100',
            'Sexo' => ' string|max:20',
            'Codigo_cliente' => 'integer|exists:clientes,id'
        ]);

        // Actualizar la mascota con los datos proporcionados en la solicitud
        $mascota = new Mascota;
        $mascota->nombre = $request->nombre;
        $mascota->raza = $request->raza;
        $mascota->Sexo = $request->Sexo;
        $mascota->Codigo_cliente = $request->Codigo_cliente;
        $mascota->update();

        // Retornar la mascota actualizada como respuesta en formato JSON
        return response()->json($mascota, 200);

        }catch (\Exception $e){
            return response()->json(['error' => 'Error al actualizar la mascota '. $e], 500);

        }
        
    }

   
    
    public function destroy(Mascota $mascota)
    {
        // Eliminar la mascota de la base de datos
        $mascota->delete();

        // Retornar una respuesta exitosa en formato JSON
        return response()->json(['message' => 'Mascota eliminada correctamente'], 200);
    }
}
