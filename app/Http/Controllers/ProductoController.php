<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        try {
            $search = $request->input('search');

             $query = Producto::with('categoria');

            // Filtro de búsqueda
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', "%$search%")
                        ->orWhere('descripcion', 'like', "%$search%")
                        ->orWhere('precio', 'like', "%$search%");
                });
            }
            // Filtro por estado
            if ($request->has('no_disponibles')) {
                $query->where('estado', 'No Disponibles');
            } else {
                $query->where('estado', 'Disponibles');
            }
            $noDisponiblesCount = Producto::where('estado', 'No Disponibles')->count();
            $productos = $query->paginate(8)->appends($request->all());

            return view('productos.index', compact('productos', 'noDisponiblesCount'));
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
     

         $categorias = Categoria::where('estado', 'activo')->get();
        return view('productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //metodo para guardar un nuevo producto
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
            ],
            'descripcion' => [
                'required',
                'string',
                'max:1000',
            ],
            'precio' => [
                'required',
                'numeric',
                'min:0',
                'max:999999',
                function ($attribute, $value, $fail) {
                    if (!is_finite($value)) {
                        $fail("El campo $attribute no puede ser infinito o NaN.");
                    }
                },
            ],
            'stock' => [
                'required',
                'integer',
                'min:0',
                'max:10000',
            ],
                    'categoria_id' => [
            'required',
            'exists:categorias,id',
        ],
            'estado' => [
                'required',
                'string',
                'in:Disponibles,No Disponibles',
            ],
        ], [
            // Mensajes personalizados
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.string'   => 'El nombre debe ser texto.',
            'nombre.max'      => 'El nombre no puede superar los 255 caracteres.',

            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string'   => 'La descripción debe ser texto.',
            'descripcion.max'      => 'La descripción no puede superar los 1000 caracteres.',

            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric'  => 'El precio debe ser un número válido.',
            'precio.min'      => 'El precio no puede ser negativo.',
            'precio.max'      => 'El precio no puede superar 999,999.',

            'stock.required' => 'El stock es obligatorio.',
            'stock.integer'  => 'El stock debe ser un número entero.',
            'stock.min'      => 'El stock no puede ser negativo.',
            'stock.max'      => 'El stock no puede superar 10,000 unidades.',

            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists'   => 'La categoría seleccionada no es válida.',

            'estado.required' => 'El estado es obligatorio.',
            'estado.in'       => 'El estado debe ser Disponible o No Disponible.',
        ]);

        Producto::create($request->all());


        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        
        //
        $categorias = Categoria::where('estado', 'activo')->get();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //metodo para actualizar un producto existente
        //metodo para guardar un nuevo producto
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
            ],
            'descripcion' => [
                'required',
                'string',
                'max:1000',
            ],
            'precio' => [
                'required',
                'numeric',
                'min:0',
                'max:999999',
                function ($attribute, $value, $fail) {
                    if (!is_finite($value)) {
                        $fail("El campo $attribute no puede ser infinito o NaN.");
                    }
                },
            ],
            'stock' => [
                'required',
                'integer',
                'min:0',
                'max:10000',
            ],
            'categoria_id' => [
                'required',
                'exists:categorias,id',
            ],
            'estado' => [
                'required',
                'string',
                'in:Disponibles,No Disponibles',
            ],

        ], [
            // Mensajes personalizados
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.string'   => 'El nombre debe ser texto.',
            'nombre.max'      => 'El nombre no puede superar los 255 caracteres.',

            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string'   => 'La descripción debe ser texto.',
            'descripcion.max'      => 'La descripción no puede superar los 1000 caracteres.',

            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric'  => 'El precio debe ser un número válido.',
            'precio.min'      => 'El precio no puede ser negativo.',
            'precio.max'      => 'El precio no puede superar 999,999.',

            'stock.required' => 'El stock es obligatorio.',
            'stock.integer'  => 'El stock debe ser un número entero.',
            'stock.min'      => 'El stock no puede ser negativo.',
            'stock.max'      => 'El stock no puede superar 10,000 unidades.',

            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists'   => 'La categoría seleccionada no es válida.',

            'estado.required' => 'El estado es obligatorio.',
            'estado.in'       => 'El estado debe ser Disponible o No Disponible.',
        ]);


        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }



   
}
