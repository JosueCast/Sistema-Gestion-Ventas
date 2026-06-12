<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control de Edicion Productos') }}
        </h2>
    </x-slot>


    <!-- Contenido principal -->
    <div class="flex justify-center mx-auto w-full px-4 py-6">
        <div class="bg-white shadow-lg rounded-lg px-4 py-6 w-1/4">
            <div class="border-b px-6 py-4 ">
                <h5 class="text-4xl font-semibold text-gray-700 mt-2 ">Actualizar Producto</h5>
            </div>
            <div class="p-6">
                <!-- Mensajes de error generales -->
                @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-100 border border-red-400 text-red-700">
                    <strong>Por favor corrige los siguientes errores:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- Formulario para actualizar un producto -->

                <form id="productoForm" action="{{ route('productos.update', $producto->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="nombre" class="block text-xl font-medium text-gray-700 ">Nombre del producto</label>
                        <input placeholder="Ingrese el nombre" type="text" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('nombre')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="descripcion" class="block text-xl font-medium text-gray-700">Breve Descripción</label>
                        <textarea placeholder="Ingrese la descripción" name="descripcion" id="descripcion" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('descripcion', $producto->descripcion) }}</textarea>
                        @error('descripcion')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-space-between">
                        <div class=" mr-2">
                            <label for="precio" class="block text-xl font-medium text-gray-700">Precio</label>
                            <input placeholder="Ingrese el precio" type="number" min="0" name="precio" id="precio" value="{{ old('precio', $producto->precio) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('precio')
                            <p class="mt-2 text-sm text-red-600">{{ $message}}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="stock" class="block text-xl font-medium text-gray-700">Stock</label>
                            <input placeholder="Ingrese el stock" type="number" min="0" max="10000" name="stock" id="stock" value="{{ old('stock', $producto->stock) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('stock')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="flex justify-space-between">
                        <div hidden class="px-2">
                            <label for="estado" class="block text-xl font-medium text-gray-700">Estado</label>
                            <select name="estado" id="estado" required value="{{ old('estado', $producto->estado) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Disponibles">Disponible</option>
                                <option value="No Disponibles">No Disponible</option>
                            </select>
                        </div>

                        <div>
                            <label for="categoria" class="block text-xl font-medium text-gray-700">Categoría</label>
                            <select name="categoria_id" id="categoria_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>

                                @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                                @endforeach

                            </select>
                        </div>
                    </div>



                    <div class="flex justify-space-between">
                        <button type="button"
                            onclick="document.getElementById('confirmStoreModal').classList.remove('hidden')"
                            class="px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                            Actualizar Producto
                        </button>
                        <button type="button" class="ml-4 px-4 py-2 bg-gray-500 text-white rounded-md text-lg text-semibold shadow hover:bg-gray-600 transition">
                            <a href="{{ route('productos.index') }}">Cancelar</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Botón que abre el modal -->

    <!-- Modal de confirmación -->
    <div id="confirmStoreModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-xl shadow-lg p-6 w-96">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Confirmar actualización</h2>
            <p class="text-gray-600 mb-6">¿Estás seguro de que deseas actualizar este producto?</p>
            <div class="flex justify-end space-x-3">
                <!-- Botón cancelar -->
                <button type="button"
                    onclick="document.getElementById('confirmStoreModal').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                    Cancelar
                </button>
                <!-- Botón confirmar -->
                <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="button"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition"
                        onclick="document.getElementById('productoForm').submit()">
                        Confirmar
                    </button>
                </form>
            </div>
        </div>
    </div>




</x-app-layout>