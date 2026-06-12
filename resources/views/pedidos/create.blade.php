<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control de Pedidos') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">


        <div class="container mx-auto px-4 py-6 max-w-2xl bg-white rounded shadow border p-6">

            <h1 class="text-2xl font-bold mb-6">Nuevo Pedido</h1>

            {{-- Errores de validación --}}
            @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc pl-4">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('pedidos.store') }}" method="POST">
                @csrf

                {{-- Selector de cliente --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Cliente</label>
                    <select name="cliente_id"
                        class="w-full border rounded p-2 @error('cliente_id') border-red-500 @enderror">
                        <option value="">-- Selecciona un cliente --</option>
                        @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}"
                            {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }} — {{ $cliente->email }}
                        </option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Productos dinámicos --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-2">Productos</label>

                    <div id="productos-lista">
                        {{-- Fila de producto (se repite con JS) --}}
                        <div class="flex gap-2 mb-2 producto-fila">
                            <select name="productos[0][id]"

                                class="flex-1 border rounded p-2 producto-select"
                                onchange="actualizarTotal() ">
                                <option id="producto-seleccionado" value="">-- Producto --</option>
                                @forelse($productos as $p)
                                <option value="{{ $p->id }}"
                                    data-precio="{{ $p->precio }}"
                                    data-stock="{{ $p->stock }}">
                                    {{ $p->nombre }} — ${{ $p->precio }}
                                </option>
                                @empty
                                <option value="" disabled>No hay productos disponibles</option>
                                @endforelse
                            </select>

                            <input  id="input-stock" type="number" name="productos[0][cantidad]"
                                value="1" min="1"
                                class="w-20 border rounded p-2 cantidad-input"
                                oninput="validarCantidad(this)
                                
                                " disabled>

                            <button type="button"
                                onclick="this.closest('.producto-fila').remove(); actualizarTotal()"
                                class="text-red-500 px-3 border rounded hover:bg-red-50">✕</button>
                        </div>
                    </div>

                    <button type="button" onclick="agregarProducto()"
                        class="text-blue-500 text-sm mt-1 hover:underline">
                        + Agregar otro producto
                    </button>
                </div>

                {{-- Notas opcionales --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Notas (opcional)</label>
                    <textarea name="notas" rows="2"
                        class="w-full border rounded p-2">{{ old('notas') }}</textarea>
                </div>

                {{-- Total calculado --}}
                <div class="bg-gray-50 border rounded p-4 mb-6 flex justify-between items-center">
                    <span class="font-semibold">Total estimado:</span>
                    <span id="total-display" class="text-2xl font-bold">$0.00</span>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600 font-semibold">
                        Crear Pedido
                    </button>
                    <a href="{{ route('pedidos.index') }}"
                        class="border px-6 py-2 rounded hover:bg-gray-50">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function actualizarOpciones() {


            if (document.getElementById('producto-seleccionado').value != "") {
                alert("hola");
            }


            //const cantidadInput = document.getElementById('cantidad-input').disabled = true;



        }

        function validarCantidad(input) {
            const max = parseInt(input.max);
            const value = parseInt(input.value);

            if (value > max) {
                input.value = max; // ajusta automáticamente al máximo
                Swal.fire({
                    icon: 'error',
                    title: 'Cantidad inválida',
                    text: `No puedes vender más de ${max} unidades de este producto`
                });
            }

            actualizarTotal(); // sigue calculando el total
        }

        const opcionesProducto = `
@foreach($productos as $p)
<option value="{{ $p->id }}" data-precio="{{ $p->precio }}">
    {{ $p->nombre }} — \${{ $p->precio }}
</option>
@endforeach
`;

        let filaIndex = 1;

        function agregarProducto() {
            const lista = document.getElementById('productos-lista');
            const fila = document.createElement('div');
            fila.className = 'flex gap-2 mb-2 producto-fila';

            fila.innerHTML = `
            <select name="productos[${filaIndex}][id]"
                    class="flex-1 border rounded p-2 producto-select"
                    onchange="actualizarTotal(); actualizarOpciones();">

                <option value="">-- Producto --</option>
                ${opcionesProducto}
            </select>

            <input type="number"
                   name="productos[${filaIndex}][cantidad]"
                   value="1"
                   min="1"
                   class="w-20 border rounded p-2 cantidad-input"
                   oninput="actualizarTotal()">

            <button type="button"
                    onclick="eliminarFila(this)"
                    class="text-red-500 px-3 border rounded hover:bg-red-50">
                ✕
            </button>
        `;

            lista.appendChild(fila);
            filaIndex++;
            actualizarTotal();
            actualizarOpciones();
        }

        function eliminarFila(btn) {
            const filas = document.querySelectorAll('.producto-fila');
            if (filas.length > 1) {
                btn.closest('.producto-fila').remove();
            }
            actualizarTotal();
            actualizarOpciones();
        }

        function actualizarTotal() {
            let total = 0;

            document.querySelectorAll('.producto-fila').forEach(fila => {
                const select = fila.querySelector('.producto-select');
                const cantidadInput = fila.querySelector('.cantidad-input');
                const option = select.options[select.selectedIndex];

                if (select.value !== "") {
                    // habilitar input y ajustar max según stock
                    const stock = parseInt(option.dataset.stock || 1);
                    cantidadInput.disabled = false;
                    cantidadInput.max = stock;
                } else {
                    // deshabilitar si no hay producto
                    cantidadInput.disabled = true;
                    cantidadInput.value = 1;
                    cantidadInput.max = 1;
                }

                const precio = parseFloat(option.dataset.precio || 0);
                const cantidadValue = parseInt(cantidadInput.value || 0);
                total += precio * cantidadValue;
            });

            document.getElementById('total-display').textContent =
                '$' + total.toFixed(2);
        }


        function actualizarOpciones() {
            // Obtener todos los productos seleccionados
            const seleccionados = Array.from(document.querySelectorAll('.producto-select'))
                .map(sel => sel.value)
                .filter(val => val !== "");

            // Deshabilitar opciones ya seleccionadas en otros selects
            document.querySelectorAll('.producto-select').forEach(select => {
                Array.from(select.options).forEach(opt => {
                    if (opt.value !== "" && seleccionados.includes(opt.value) && opt.value !== select.value) {
                        opt.disabled = true;
                    } else {
                        opt.disabled = false;
                    }
                });
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            actualizarTotal();
            actualizarOpciones();
        });
    </script>

</x-app-layout>