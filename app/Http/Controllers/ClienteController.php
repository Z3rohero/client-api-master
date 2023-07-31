<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()

    //este metodo muestra todos los clientes
    {
        return Cliente::all();
       // return response()->json(['message' => 'funciona'], 200);

    }

   
    public function store(Request $request)
    {
        try {
            // Validar los datos recibidos en la solicitud
            
            
            $request->validate([
                'Nombre_Cliente' => 'required|string|max:100',
                'Documento' => 'required|string|max:100',
                'Sexo' => 'required|string|max:20',
            ]);

            $Cliente = New Cliente;
            $Cliente->Nombre_Cliente = $request->Nombre_Cliente;
            $Cliente->Documento = $request->Documento;
            $Cliente->Sexo = $request->Sexo;
            $Cliente->save();

            

            // Crear un nuevo cliente con los datos proporcionados en la solicitud
           
        
            // Retornar el cliente recién creado como respuesta en formato JSON
            return response()->json($Cliente, 201);
        } catch (\Exception $e) {
            // En caso de excepción, retornar un mensaje de error en formato JSON
            return response()->json(['error' => 'Error al crear el cliente '. $e], 500);
        }
    }

    public function show(Cliente $cliente)
    //este metodo muestra un cliente especifico
    {
        // Retorna el cliente especificado en la solicitud como respuesta en formato JSON
        return $cliente;

    }

    public function update(Request $request, Cliente $cliente)
    {
        try {
            // Validar los datos recibidos en la solicitud
            $request->validate([
                'Nombre_Cliente' => 'required|string|max:100',
                'Documento' => 'required|string|max:100',
                'Sexo' => 'required|string|max:20',
            ]);
    
            // Actualizar el cliente con los datos proporcionados en la solicitud
            $cliente->Nombre_Cliente = $request->input('Nombre_Cliente');
            $cliente->Documento = $request->input('Documento');
            $cliente->Sexo = $request->input('Sexo');
            $cliente->save();
    
            return response()->json($cliente, 200);
        } catch (\Exception $e) {
            // En caso de excepción, retornar un mensaje de error en formato JSON
            return response()->json(['error' => 'Error al actualizar el cliente'], 500);
        }
    }
    

    public function destroy(Cliente $cliente)
    {
        // Eliminar el cliente de la base de datos
        $cliente->delete();

        // Retornar una respuesta exitosa en formato JSON
        return response()->json(['message' => 'Cliente eliminado correctamente'], 200);
    }
}
