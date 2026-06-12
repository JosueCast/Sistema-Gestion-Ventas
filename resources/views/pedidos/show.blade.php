<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control de Pedidos') }}
        </h2>
    </x-slot>

<div class="container mx-auto px-4 py-6 max-w-2xl bg-white rounded shadow border p-6 mt-6">

    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-2xl font-bold">
                Pedido #{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}
            </h1>
            <p class="text-gray-400 text-sm">
                {{ $pedido->created_at->format('d/m/Y H:i') }}
            </p>
        </div>
        <a href="{{ route('pedidos.index') }}"
           class="text-white hover:text-gray-400 border rounded p-2 bg-gray-600">← Volver</a>
    </div>

    {{-- Info del cliente --}}
    <div class="bg-gray-50 border rounded p-4 mb-6">
        <h3 class="font-semibold mb-1">Cliente</h3>
        <p class="font-medium">{{ $pedido->cliente->nombre }}</p>
        <p class="text-sm text-gray-500">{{ $pedido->cliente->email }}</p>
        <p class="text-sm text-gray-500">{{ $pedido->cliente->telefono }}</p>
    </div>

    {{-- Tabla de productos del pedido --}}
    <table class="w-full border-collapse mb-6">
        <thead>
            <tr class="bg-gray-100 text-left text-sm">
                <th class="p-3">Producto</th>
                <th class="p-3 text-right">Precio unit.</th>
                <th class="p-3 text-right">Cantidad</th>
                <th class="p-3 text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->productos as $producto)
            <tr class="border-b">
                <td class="p-3">{{ $producto->nombre }}</td>
                <td class="p-3 text-right">
                    {{-- Precio histórico del pivot, no el actual --}}
                    ${{ number_format($producto->pivot->precio_unitario, 2) }}
                </td>
                <td class="p-3 text-right">{{ $producto->pivot->cantidad }}</td>
                <td class="p-3 text-right font-medium">
                    ${{ number_format($producto->pivot->precio_unitario * $producto->pivot->cantidad, 2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="p-3 text-right font-bold">Total:</td>
                <td class="p-3 text-right font-bold text-lg">
                    ${{ number_format($pedido->total, 2) }}
                </td>
            </tr>
        </tfoot>
    </table>

    {{-- Cambiar estado --}}
    <form action="{{ route('pedidos.update', $pedido) }}" method="POST"
          class="flex items-center gap-3">
        @csrf @method('PUT')
        <label class="font-semibold">Estado:</label>
        <select name="estado" class="border rounded p-2">
            @foreach(['pendiente', 'procesando', 'enviado', 'entregado'] as $est)
                <option {{ $pedido->estado === $est ? 'selected' : '' }}
                        value="{{ $est }}">{{ ucfirst($est) }}</option>
            @endforeach
        </select>
        <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Actualizar estado
        </button>
    </form>

</div>

</x-app-layout>