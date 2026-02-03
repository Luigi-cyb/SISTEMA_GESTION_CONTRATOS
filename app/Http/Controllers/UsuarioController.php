<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auditoria;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Listar todos los usuarios
     */
    public function index(Request $request): View
    {
        // Verificar permiso
        if (!auth()->user()->can('view.usuarios')) {
            abort(403, 'No tienes permiso para ver usuarios.');
        }

        $search = $request->input('search');
        $rol = $request->input('rol');

        $query = User::with('roles');

        // Búsqueda por nombre o email
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        // Filtro por rol
        if ($rol) {
            $query->whereHas('roles', function ($q) use ($rol) {
                $q->where('name', $rol);
            });
        }

        $usuarios = $query->paginate(15);
        $roles = Role::all();

        return view('usuarios.index', compact('usuarios', 'roles', 'search', 'rol'));
    }

    /**
     * Mostrar formulario para crear usuario
     */
    public function create(): View
    {
        // Verificar permiso
        if (!auth()->user()->can('create.usuarios')) {
            abort(403, 'No tienes permiso para crear usuarios.');
        }

        $roles = Role::all();

        return view('usuarios.create', compact('roles'));
    }

    /**
     * Guardar nuevo usuario
     */
    public function store(Request $request): RedirectResponse
    {
        // Verificar permiso
        if (!auth()->user()->can('create.usuarios')) {
            abort(403, 'No tienes permiso para crear usuarios.');
        }

        // Validar datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        // Crear usuario
        $usuario = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Asignar roles
        $roles = Role::whereIn('id', $validated['roles'])->pluck('name');
        $usuario->syncRoles($roles);

        // ========== AUDITORÍA ==========
        Auditoria::registrar(
            'Crear Usuario',
            'Usuario',
            $usuario->id,
            ['nombre' => $usuario->name, 'email' => $usuario->email, 'roles' => $roles->toArray()]
        );

        return redirect()->route('usuarios.index')
                        ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Mostrar detalle de usuario
     */
    public function show(User $usuario): View
    {
        // Verificar permiso
        if (!auth()->user()->can('view.usuarios')) {
            abort(403, 'No tienes permiso para ver usuarios.');
        }

        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Mostrar formulario para editar usuario
     */
    public function edit(User $usuario): View
    {
        // Verificar permiso
        if (!auth()->user()->can('edit.usuarios')) {
            abort(403, 'No tienes permiso para editar usuarios.');
        }

        $roles = Role::all();
        $usuarioRoles = $usuario->roles->pluck('id')->toArray();

        return view('usuarios.edit', compact('usuario', 'roles', 'usuarioRoles'));
    }

    /**
     * Actualizar usuario
     */
    public function update(Request $request, User $usuario): RedirectResponse
    {
        // Verificar permiso
        if (!auth()->user()->can('edit.usuarios')) {
            abort(403, 'No tienes permiso para editar usuarios.');
        }

        // Validar datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'password' => 'nullable|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        // Actualizar datos del usuario
        $usuario->name = $validated['name'];
        $usuario->email = $validated['email'];

        if (!empty($validated['password'])) {
            $usuario->password = Hash::make($validated['password']);
        }

        $usuario->save();

        // Asignar roles
        $roles = Role::whereIn('id', $validated['roles'])->pluck('name');
        $usuario->syncRoles($roles);

        // ========== AUDITORÍA ==========
        Auditoria::registrar(
            'Editar Usuario',
            'Usuario',
            $usuario->id,
            ['nombre' => $usuario->name, 'email' => $usuario->email, 'roles' => $roles->toArray()]
        );

        return redirect()->route('usuarios.index')
                        ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Eliminar usuario
     */
    public function destroy(User $usuario): RedirectResponse
    {
        // Verificar permiso
        if (!auth()->user()->can('delete.usuarios')) {
            abort(403, 'No tienes permiso para eliminar usuarios.');
        }

        // No permitir eliminarse a sí mismo
        if ($usuario->id === auth()->id()) {
            return redirect()->route('usuarios.index')
                            ->with('error', 'No puedes eliminarte a ti mismo.');
        }

        // ========== AUDITORÍA (ANTES DE ELIMINAR) ==========
        Auditoria::registrar(
            'Eliminar Usuario',
            'Usuario',
            $usuario->id,
            ['nombre' => $usuario->name, 'email' => $usuario->email]
        );

        $usuario->delete();

        return redirect()->route('usuarios.index')
                        ->with('success', 'Usuario eliminado exitosamente.');
    }
}