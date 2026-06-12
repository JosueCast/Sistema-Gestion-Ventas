<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control de Productos') }}
        </h2>
    </x-slot>



    <!-- Contenido principal -->
    <div class="flex justify-center mx-auto px-4 py-6">
        <div class="bg-white shadow-lg rounded-lg">
            <div class="border-b px-6 py-4">
                <!-- Encabezado -->
                <div class="border-b px-6 py-4">
                    <!-- Encabezado con botón -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <h5 class="text-4xl font-semibold text-gray-700">Productos</h5>
                            <a href="{{ route('productos.create') }}"
                                class="text-sm px-4 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600 transition">
                                Agregar Producto
                            </a>
                        </div>

                        <!-- Filtros y búsqueda alineados a la derecha -->
                        <form action="{{ route('productos.index') }}" method="GET" class="flex items-center space-x-4">
                            <!-- Checkbox -->
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name="no_disponibles" id="no_disponibles" value="1"
                                    {{ request('no_disponibles') ? 'checked' : '' }}
                                    class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="no_disponibles" class="text-gray-700">
                                    Mostrar No Disponibles ({{ $noDisponiblesCount }})
                                </label>
                            </div>

                            <!-- Campo de búsqueda -->
                            <input type="text" name="search" placeholder="Buscar por nombre o categoría"
                                value="{{ old('search', request('search')) }}"
                                class="w-80 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                            <!-- Botón -->
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 transition">
                                Buscar
                            </button>
                        </form>
                    </div>
                </div>



            </div>


            <div class="p-6">
                <div class="overflow-x-auto">
                    @if(session('error'))
                    <div
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 3000)"
                        x-transition:enter="transform ease-out duration-500 transition"
                        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="bg-red-600 text-white p-3 rounded mb-4 shadow-lg top-6 right-6 z-50 w-full max-w-sm fixed">
                        {{ session('error') }}
                    </div>
                    @endif

                    <table class="min-w-full border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th hidden class="px-4 py-2 text-left text-xl font-medium text-gray-600">ID</th>
                                <th class="px-4 py-2 text-left text-xl font-medium text-gray-600">Nombre</th>
                                <th class="px-4 py-2 text-left text-xl font-medium text-gray-600">Descripción</th>
                                <th class="px-4 py-2 text-left text-xl font-medium text-gray-600">Precio</th>
                                <th class="px-4 py-2 text-left text-xl font-medium text-gray-600">Stock</th>
                                <th class="px-4 py-2 text-left text-xl font-medium text-gray-600">Categoría</th>
                                <th class="px-4 py-2 text-left text-xl font-medium text-gray-600">Estado</th>
                                <th class="px-4 py-2 text-left text-xl font-medium text-gray-600">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($productos as $producto)
                            <tr class="hover:bg-gray-100 transition">
                                <td hidden class="px-4 py-2 text-xl text-gray-700">{{ $producto->id }}</td>
                                <td class="px-4 py-2 text-xl text-gray-700">{{ $producto->nombre }}</td>
                                <td class="px-4 py-2 text-xl text-gray-700">{{ $producto->descripcion }}</td>
                                <td class="px-4 py-2 text-xl text-gray-700">$ {{ $producto->precio }}</td>

                                <td class="px-4 py-2 text-xl text-gray-700 text-center">
                                    <span class="px-2 py-1 rounded-full text-xl font-semibold
                                        @if($producto->stock <= 5)
                                            bg-red-300 text-red-700
                                        @elseif($producto->stock <= 10)
                                            bg-orange-300 text-orange-700
                                        @else
                                            bg-green-300 text-green-700
                                        @endif">
                                        {{ $producto->stock }}
                                    </span>
                                </td>


                                <td class="px-4 py-2 text-xl text-gray-700">{{ $producto->categoria?->nombre }}</td>
                                <td class="px-4 py-2 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xl font-semibold  text-center 
                                    {{ $producto->estado == 'Disponibles' ? 'bg-green-300 text-green-700' : 'bg-red-300 text-red-700' }}">
                                        {{ $producto->estado}}

                                    </span>
                                </td>
                                <td class="px-4 py-3 text-lg text-gray-700">
                                    <div class="flex space-x-3">
                                        <!-- Botón Editar -->
                                        <a href="{{ route('productos.edit', $producto->id) }}"
                                            class="inline-flex items-center px-3 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 transition">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z" clip-rule="evenodd" />
                                            </svg>
                                            Editar

                                        </a>


                                        <!-- Botón cambiar estado de producto
                                         No es nesesario ya que en el Modelo agregamos una validacion para que no se pueda cambiar el estado 
                                         a No Disponibles si el stock es mayor a 0, y en la vista de editar producto se muestra un mensaje de 
                                         error si se intenta hacer eso.
                                        -->







                                    </div>
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
                                            No hay Productos registrados
                                        </p>

                                        <p class="text-gray-400 mt-2">
                                            Agrega un nuevo producto para comenzar.
                                        </p>

                                    </div>

                                </td>
                            </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $productos->links()}}
                </div>
            </div>
        </div>
    </div>










</x-app-layout>