<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');

        $query = User::select('id', 'name', 'apellido', 'email', 'rol');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('apellido', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('rol', 'like', "%{$search}%");
            });
        }

        return response()->json($query->paginate(5)); // 5 registros por página
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'rol' => 'required|string|in:admin,cliente',
            'password' => 'required|string|min:6'
        ]);

        $user = new User();
        $user->name = $validated['nombre'];
        $user->apellido = $validated['apellido'];
        $user->email = $validated['email'];
        $user->rol = $validated['rol'];
        $user->password = bcrypt($validated['password']);
        $user->save();

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'rol' => 'required|string|in:admin,cliente',
            'password' => 'nullable|string|min:6'
        ]);

        $user->name = $validated['nombre'];
        $user->apellido = $validated['apellido'];
        $user->email = $validated['email'];
        $user->rol = $validated['rol'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return response()->json($user);
    }
}
