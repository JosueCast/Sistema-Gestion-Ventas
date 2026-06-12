<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Cliente;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $estado = $request->get('estado');
        $search = $request->get('search');

        // Construimos la consulta con relaciones
        $query = Pedidos::with(['cliente', 'productos'])->latest();

        // Filtro por estado
        if ($estado && $estado !== 'todos') {
            $query->where('estado', $estado);
        }

        // Filtro por búsqueda (cliente o producto)
        if ($search) {
            $query->whereHas('cliente', function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%");
            })->orWhereHas('productos', function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%");
            });
        }
        $productos = Producto::select('id', 'nombre', 'precio', 'stock')->where('estado', 'Disponibles')->get();
        // Paginamos resultados
        $pedidos = $query->paginate(10);

        // Conteos por estado
        $conteos = [
            'pendiente'  => Pedidos::where('estado', 'pendiente')->count(),
            'procesando' => Pedidos::where('estado', 'procesando')->count(),
            'enviado'    => Pedidos::where('estado', 'enviado')->count(),
            'entregado'  => Pedidos::where('estado', 'entregado')->count(),
            'cancelado'  => Pedidos::where('estado', 'cancelado')->count(),
        ];

        return view('pedidos.index', compact('pedidos', 'estado', 'search', 'conteos', 'productos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $clientes  = Cliente::orderBy('nombre')->get();
        $productos = Producto::orderBy('nombre')->where('estado', 'Disponibles')->get();
        return view('pedidos.create', compact('clientes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'              => 'required|exists:clientes,id',
            'productos'               => 'required|array|min:1',
            'productos.*.id'          => 'required|exists:productos,id',
            'productos.*.cantidad'    => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {

            // 1. Crear pedido
            $pedido = Pedidos::create([
                'cliente_id' => $request->cliente_id,
                'estado'     => 'pendiente',
                'total'      => 0,
            ]);

            // 2. Agrupar productos repetidos
            $productosAgrupados = [];
            foreach ($request->productos as $item) {
                $productoId = $item['id'];
                $cantidad   = (int) $item['cantidad'];

                if (!$productoId) continue;

                if (isset($productosAgrupados[$productoId])) {
                    $productosAgrupados[$productoId] += $cantidad;
                } else {
                    $productosAgrupados[$productoId] = $cantidad;
                }
            }

            // 3. Insertar productos sin duplicados y descontar stock
            $total = 0;
            foreach ($productosAgrupados as $productoId => $cantidad) {
                $producto = Producto::findOrFail($productoId);

                // Validar stock disponible
                if ($cantidad > $producto->stock) {
                    throw new \Exception("El producto {$producto->nombre} no tiene suficiente stock.");
                }

                // Restar stock
                $producto->stock -= $cantidad;
                $producto->save();

                // Guardar en pivot
                $pedido->productos()->attach($productoId, [
                    'cantidad'        => $cantidad,
                    'precio_unitario' => $producto->precio,
                ]);

                $total += $producto->precio * $cantidad;
            }

            // 4. Actualizar total
            $pedido->update(['total' => $total]);
        });

        return redirect()
            ->route('pedidos.index')
            ->with('success', 'Pedido creado correctamente y stock actualizado');
    }



    /**
     * Display the specified resource.
     */
    public function show(Pedidos $pedido)
    {
        //
        $pedido->load('cliente', 'productos');
        return view('pedidos.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedidos $pedidos) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedidos $pedido)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,procesando,enviado,entregado'
        ]);

        $pedido->update(['estado' => $request->estado]);

        return back()->with('success', 'Estado del pedido actualizado correctamente.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Pedidos $pedido)
    {
        $pedido->update(['estado' => 'cancelado']);

        return back()->with('success', 'Pedido cancelado correctamente.');
    }
}
