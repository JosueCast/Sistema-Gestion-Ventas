<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    try {
        $search = $request->input('search');

        $query = Cliente::query();

        // Filtro de búsqueda
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%$search%")
                    ->orWhere('apellido', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('telefono', 'like', "%$search%");
            });

            // Verificar si el cliente existe pero está inactivo
            $cliente = Cliente::where('email', $search)->first();
            if ($cliente && $cliente->estado === 'Inactivo' && !$request->has('inactivos')) {
                return back()->with('error', 'El cliente existe pero está inactivo. Marca la casilla "inactivos" para verlo.');
            }
        }

        // Filtro por estado
        if ($request->has('inactivos')) {
            $query->where('estado', 'Inactivo');
        } else {
            $query->where('estado', 'Activo');
        }
        $noDisponiblesCount = Cliente::where('estado', 'Inactivo')->count();

        $clientes = $query->paginate(10)->appends($request->all());

        return view('clientes.index', compact('clientes', 'noDisponiblesCount'));

    } catch (\Exception $e) {
        // Captura cualquier error inesperado y lo manda a la vista
        return back()->with('error', 'Ocurrió un problema: ' . $e->getMessage());
    }
}




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación con mensajes personalizados
        $request->validate([
            'nombre'    => 'required|string|max:255|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.]+$/',
            'apellido'  => 'required|string|max:255|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.]+$/',
            'email'     => 'required|email|unique:clientes,email',
            'telefono'  => 'nullable|regex:/^[0-9]{8}$/',
            'direccion' => 'nullable|string|max:255',
            'estado'    => 'required|in:Activo,Inactivo',
        ], [
            'nombre.required'   => 'El campo nombre es obligatorio.',
            'nombre.regex'      => 'El nombre solo puede contener letras y espacios.',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'apellido.regex'    => 'El apellido solo puede contener letras y espacios.',
            'email.required'    => 'El campo email es obligatorio.',
            'email.email'       => 'Debe ingresar un correo válido.',
            'email.unique'      => 'El correo ya está registrado.',
            'telefono.regex'    => 'El teléfono debe contener exactamente 8 números.',
            'estado.required'   => 'El campo estado es obligatorio.',
            'estado.in'         => 'El estado debe ser "Activo" o "Inactivo".',
        ]);

        // Crear cliente
        Cliente::create($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('clientes.index')
            ->with('success', '¡Cliente creado exitosamente!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // Validación con reglas y mensajes personalizados
        $request->validate([
            'nombre'    => 'required|string|max:255|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.]+$/',
            'apellido'  => 'required|string|max:255|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.]+$/',
            'email'     => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefono'  => 'nullable|regex:/^[0-9]{8}$/',
            'direccion' => 'nullable|string|max:255',
            'estado'    => 'required|in:Activo,Inactivo',
        ], [
            'nombre.required'   => 'El campo nombre es obligatorio.',
            'nombre.regex'      => 'El nombre solo puede contener letras, espacios y puntos.',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'apellido.regex'    => 'El apellido solo puede contener letras, espacios y puntos.',
            'email.required'    => 'El campo email es obligatorio.',
            'email.email'       => 'Debe ingresar un correo válido.',
            'email.unique'      => 'El correo ya está registrado por otro cliente.',
            'telefono.regex'    => 'El teléfono debe contener exactamente 8 números.',
            'estado.required'   => 'El campo estado es obligatorio.',
            'estado.in'         => 'El estado debe ser "Activo" o "Inactivo".',
        ]);

        // Actualizar cliente
        $cliente->update($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('clientes.index')
            ->with('success', '¡Cliente actualizado exitosamente!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        // Eliminar cliente
        $cliente->delete();

        // Redirigir al index con mensaje de éxito
        return redirect()->route('clientes.index')
            ->with('success', '¡Cliente eliminado exitosamente!');
    }

   public function toggleEstado($id)
{
    // Buscar cliente por ID
    $cliente = Cliente::findOrFail($id);

    // Alternar estado entre Activo e Inactivo
    $cliente->estado = $cliente->estado === 'Activo' ? 'Inactivo' : 'Activo';
    $cliente->save();

    // Mensaje dinámico según el nuevo estado
    $mensaje = $cliente->estado === 'Activo' 
        ? 'El cliente ha sido activado exitosamente.' 
        : 'El cliente ha sido desactivado exitosamente.';

    // Redirigir al index con mensaje de éxito
    return redirect()->route('clientes.index')
        ->with('success', $mensaje);
}

}
