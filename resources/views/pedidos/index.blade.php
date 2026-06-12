<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control de Pedidos') }}
        </h2>
    </x-slot>


    <div class="flex justify-center item  overflow-hidden shadow-sm sm:rounded-lg w-1/2 mx-auto">
        <div class="container mx-auto px-4 py-6 bg-white rounded-lg shadow mt-8">

            {{-- Cabecera --}}
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold m-3 p-2 text-gray-800">Pedidos</h1>
                <a href="{{ route('pedidos.create') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-300 px-3  py-1 text-sm">
                    + Nuevo Pedido
                </a>
                 <form action="{{ route('pedidos.index') }}" method="GET" class="ml-auto flex items-center gap-2">
                    <input type="text" name="search" placeholder="Buscar por cliente o producto"
                        value="{{ request('search') }}"
                        class="border rounded px-3 py-1 text-sm">
                    <button type="submit" class="bg-gray-500 text-white px-3 py-1 rounded text-sm ml-2">
                        Buscar
                    </button>
                </form>
            </div>

            {{-- Mensaje de éxito --}}
            @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            {{-- Filtro rápido por estado --}}
            <div class="flex gap-2 mb-4">
                @foreach(['todos', 'pendiente', 'procesando', 'enviado', 'entregado', 'cancelado'] as $estado)
                <a href="{{ route('pedidos.index', ['estado' => $estado]) }}"
                    class="px-3 py-1 rounded text-sm border {{ request('estado') === $estado ? 'bg-blue-500 text-white' : '' }}">
                    {{ ucfirst($estado) }}
                    @if($estado !== 'todos')
                    ({{ $conteos[$estado] ?? 0 }})
                    @endif
                </a>
                @endforeach
              
            </div>

            <div class="overflow-x-auto bg-gray-100 rounded shadow border p-4">
                {{-- Tabla de pedidos --}}
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="p-3">Codigo</th>
                            <th class="p-3">Cliente</th>
                            <th class="p-3">Productos</th>
                            <th class="p-3">Total</th>
                            <th class="p-3">Estado</th>
                            <th class="p-3">Fecha</th>
                            <th class="p-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pedidos as $pedido)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 font-mono text-sm text-gray-400">
                                #{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="p-3 font-medium">
                                {{ $pedido->cliente->nombre }}
                                <div class="text-xs text-gray-400">{{ $pedido->cliente->email }}</div>
                            </td>
                            <td class="p-3 text-sm text-gray-500">
                                {{ $pedido->productos->count() }} producto(s)
                            </td>
                            <td class="p-3 font-bold">
                                ${{ number_format($pedido->total, 2) }}
                            </td>
                            <td class="p-3">
                                {{-- Badge de estado con color --}}
                                <span class="px-2 py-1 rounded text-xs font-bold
                        @if($pedido->estado === 'pendiente')   bg-yellow-100 text-yellow-700
                        @elseif($pedido->estado === 'procesando') bg-blue-100 text-blue-700
                        @elseif($pedido->estado === 'enviado')    bg-purple-100 text-purple-700
                        @elseif($pedido->estado === 'entregado')  bg-green-100 text-green-700
                        @elseif($pedido->estado === 'cancelado')   bg-red-100 text-red-700
                
                        @endif">
                                    {{ ucfirst($pedido->estado) }}
                                </span>
                            </td>
                            <td class="p-3 text-sm text-gray-400">
                                {{ $pedido->created_at->format('d/m/Y') }}
                            </td>
                            <td class="p-3 flex gap-2">
                                <a href="{{ route('pedidos.show', $pedido) }}"
                                    class="text-blue-500 hover:underline mr-2 bg-blue-500 text-white border border-blue-500 rounded px-2 py-1">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd" />
                                    </svg>

                                </a>
                                <form id="delete-form-{{ $pedido->id }}" action="{{ route('pedidos.destroy', $pedido->id) }}"
                                    method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="DeletePedido('{{ $pedido->id }}')"
                                        type="button"
                                        class="text-red-500 hover:underline bg-red-500 text-white border border-red-500 rounded px-2 py-1">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd" />
                                        </svg>

                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty

                        <tr>
                            <td colspan="8" class="text-center py-10">

                                <div class="flex flex-col items-center justify-center">

                                    <svg class="w-16 h-16 text-gray-300 mb-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M9 17v-2a4 4 0 014-4h4m0 0l-3-3m3 3l-3 3M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                    </svg>

                                    <p class="text-2xl font-semibold text-gray-500">
                                        No hay pedidos registrados
                                    </p>

                                    <p class="text-gray-400 mt-2">
                                        Agrega un nuevo pedido para comenzar.
                                    </p>

                                </div>

                            </td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>

            </div>
            {{-- Paginación --}}
            <div class="mt-4">{{ $pedidos->links() }}</div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function DeletePedido(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Estas seguro de desabilitar este pedido! No se eliminará permanentemente, pero no estará activo.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cancelarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                    Swal.fire('¡Cancelado!', 'El pedido ha sido cancelado.', 'success');

                    Swal.fire(
                        '¡Cancelado!',
                        'El pedido ha sido cancelado.',
                        'success'
                    )
                }
            });
        }
    </script>


</x-app-layout>