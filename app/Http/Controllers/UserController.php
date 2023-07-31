<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
   
        return User::all();
    }

   
    public function store(Request $request)
    {
        try {
            // Validar los datos recibidos en la solicitud
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
            ]);
            // Verificar si el usuario ya existe en la base de datos por su dirección de correo electrónico
            $existingUser = User::where('email', $request->input('email'))->first();
    
            if ($existingUser) {
                return response()->json(['error' => 'El correo electrónico ya está en uso.'], 422);
            }
    
            // Crear un nuevo usuario con los datos proporcionados en la solicitud
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
    
            // Verificar si la contraseña es válida
            if (Hash::check($request->input('password'), $user->password)) {
                return response()->json(['message' => 'Usuario creado correctamente.'], 201);
            } else {
                return response()->json(['error' => 'La contraseña no coincide con la almacenada.'], 422);
            }
    
        } catch (\Exception $e) {
            // Capturar cualquier excepción ocurrida durante el proceso
            return response()->json(['error' => 'Error al crear el usuario: ' . $e->getMessage()], 500);
        }
    }

    // ... (otros métodos del controlador)

    public function show(User $user)
    {
        // Retorna el usuario especificado en la solicitud como respuesta en formato JSON
        return response()->json($user, 200);
    }

    public function update(Request $request, User $user)
    {
        // Validar los datos recibidos en la solicitud
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        // Actualizar los datos del usuario con los datos proporcionados en la solicitud
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        // Retornar el usuario actualizado como respuesta en formato JSON
        return response()->json($user, 200);
    }

    public function destroy(User $user)
    {
        // Eliminar el usuario de la base de datos
        $user->delete();

        // Retornar una respuesta exitosa en formato JSON
        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }
}
