
// Opciones HTML de productos para clonar en nuevas filas
const opcionesProducto = `@foreach($productos as $p)
    <option value="{{ $p->id }}" data-precio="{{ $p->precio }}">
        {{ $p->nombre }} — \${{ $p->precio }}
    </option>
@endforeach`;

let filaIndex = 1;

function agregarProducto() {
    const lista = document.getElementById('productos-lista');
    const fila = document.createElement('div');
    fila.className = 'flex gap-2 mb-2 producto-fila';
    fila.innerHTML = `
        <select name="productos[${filaIndex}][id]"
                class="flex-1 border rounded p-2 producto-select"
                onchange="actualizarTotal()">
            <option value="">-- Producto --</option>
            ${opcionesProducto}
        </select>
        <input type="number" name="productos[${filaIndex}][cantidad]"
               value="1" min="1"
               class="w-20 border rounded p-2 cantidad-input"
               oninput="actualizarTotal()">
        <button type="button"
                onclick="this.closest('.producto-fila').remove(); actualizarTotal()"
                class="text-red-500 px-3 border rounded hover:bg-red-50">✕</button>
    `;
    lista.appendChild(fila);
    filaIndex++;
}

function actualizarTotal() {
    let total = 0;
    document.querySelectorAll('.producto-fila').forEach(fila => {
        const select = fila.querySelector('.producto-select');
        const cantidad = fila.querySelector('.cantidad-input');
        const precio = select.selectedOptions[0]?.dataset?.precio || 0;
        total += parseFloat(precio) * parseInt(cantidad.value || 1);
    });
    document.getElementById('total-display').textContent =
        '$' + total.toFixed(2);
}

