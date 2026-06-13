<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $search = $request->input('search');
        $query = Categoria::query();
        if (!empty($search)) {
            $query->where('nombre', 'like', "%$search%");
        }

        if ($request->has('inactivos')) {
            $query->where('estado', 'inactivo');
        } else {
            $query->where('estado', 'activo');
        }

        $noDisponiblesCount = Categoria::where('estado', 'inactivo')->count();

        $categorias = $query->paginate(5)->appends($request->all());
        return view('categorias.index', compact('categorias', 'noDisponiblesCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validación con reglas y mensajes personalizados
        $request->validate([
            'nombre'    => 'required|string|min:2|max:255',
            'estado'    => 'required|in:activo,inactivo',
        ], [
            'nombre.required'   => 'El campo nombre es obligatorio.',
            'nombre.min'        => 'El nombre debe tener al menos 2 caracteres.',
            'nombre.max'        => 'El nombre no puede exceder los 255 caracteres.',        
            'estado.required'   => 'El campo estado es obligatorio.',
            'estado.in'         => 'El estado debe ser "Activo" o "Inactivo".',
        ]);
        // Crear nueva Categoría
        Categoria::create($request->all());
        // Redirigir con mensaje de éxito
        return redirect()->route('categorias.index')
            ->with('success', '¡Categoría creada exitosamente!');   
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
        // Validación con reglas y mensajes personalizados
        $request->validate([
            'nombre'    => 'required|string|min:2|max:255',
            'estado'    => 'required|in:activo,inactivo',
        ], [
            'nombre.required'   => 'El campo nombre es obligatorio.',
            'nombre.min'        => 'El nombre debe tener al menos 2 caracteres.',
            'nombre.max'        => 'El nombre no puede exceder los 255 caracteres.',
            'estado.required'   => 'El campo estado es obligatorio.',
            'estado.in'         => 'El estado debe ser "Activo" o "Inactivo".',
        ]);
        // Actualizar Categoría
        $categoria->update($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('categorias.index')
            ->with('success', '¡Categoría actualizada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria) {}

    public function toggleEstado($id)
    {
        // Buscar cliente por ID
        $categoria = Categoria::findOrFail($id);

        // Alternar estado entre Activo e Inactivo
        $categoria->estado = $categoria->estado === 'activo' ? 'inactivo' : 'activo';
        $categoria->save();

        // Mensaje dinámico según el nuevo estado
        $mensaje = $categoria->estado === 'activo'
            ? 'La categoría ha sido activada exitosamente.'
            : 'La categoría ha sido desactivada exitosamente.';

        // Redirigir al index con mensaje de éxito
        return redirect()->route('categorias.index')
            ->with('success', $mensaje);
    }
}
