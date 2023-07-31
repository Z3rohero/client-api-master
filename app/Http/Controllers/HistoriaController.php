<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use Illuminate\Http\Request;

class HistoriaController extends Controller
{
    public function index()
    {
        // Obtener todas las historias y retornarlas como respuesta en formato JSON
        $historias = Historia::all();
        return response()->json($historias, 200);
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'temperatura' => 'required|numeric', // 5 dígitos en total, 2 decimales
                'peso' => 'required|numeric', // 6 dígitos en total, 2 decimales
                'frecuencia_cardiaca' => 'required|integer',
                'observacion' => 'nullable|string',
                'cliente_id' => 'required|integer|exists:clientes,id',
                'mascota_id' => 'required|integer|exists:mascotas,id'

            ]);
    
            $Historia = New Historia;
            $Historia->temperatura = $request->temperatura;
            $Historia->peso = $request->peso;
            $Historia->frecuencia_cardiaca = $request->frecuencia_cardiaca;
            $Historia->observacion = $request->observacion;
            $Historia->cliente_id = $request->cliente_id;
            $Historia->mascota_id = $request->mascota_id;
            $Historia->save();
          

            // Retornar la historia recién creada como respuesta en formato JSON
            return response()->json($Historia, 200);
        }
        catch (\Exception $e){
            return response()->json(['error' => 'Error al crear la historia '. $e], 500);

        }
        
    }

    public function show(Historia $historia)
    {
        // Retorna la historia especificada en la solicitud como respuesta en formato JSON
        return response()->json($historia, 200);
    }

    public function update(Request $request, Historia $historia)
    {
        
        try{ // Validar los datos recibidos en la solicitud
            $request->validate([
                'temperatura' => 'required|numeric', // 5 dígitos en total, 2 decimales
                'peso' => 'required|numeric', // 6 dígitos en total, 2 decimales
                'frecuencia_cardiaca' => 'required|integer',
                'observacion' => 'nullable|string',
                'cliente_id' => 'integer|exists:clientes,id',
               'mascota_id' => 'integer|exists:mascotas,id'
    
            ]);
    
    
            $Historia = New Historia;
            $Historia->temperatura = $request->temperatura;
            $Historia->peso = $request->peso;
            $Historia->frecuencia_cardiaca = $request->frecuencia_cardiaca;
            $Historia->observacion = $request->observacion;
            $Historia->cliente_id = $request->cliente_id;
            $Historia->mascota_id = $request->mascota_id;
            $Historia->update();
            // Retornar la historia actualizada como respuesta en formato JSON
            return response()->json(['message' => $Historia], 200);
    

        }catch (\Exception $e){
            return response()->json(['error' => 'Error a actualiza'. $e], 500);

        }
       
    }

    public function destroy(Historia $historia)
    {
        // Eliminar la historia de la base de datos
        $historia->delete();
        // Retornar una respuesta exitosa en formato JSON
        return response()->json(['message' => 'Historia eliminada correctamente'], 200);
    }
}
