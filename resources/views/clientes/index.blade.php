<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control de Clientes') }}
        </h2>
    </x-slot>


    {{-- FLASH MESSAGE --}}
    @if(session('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition:enter="transform ease-out duration-500 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed top-6 right-6 z-50">

        <div class="flex items-center w-full max-w-sm p-4 text-green-800 bg-white border border-green-200 rounded-2xl shadow-2xl">

            <!-- Icono -->
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-100">
                <svg class="w-6 h-6 text-green-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <!-- Texto -->
            <div class="ml-4">

                <h3 class="text-sm font-bold text-green-700">
                    Operación Exitosa
                </h3>

                <p class="text-sm text-gray-600">
                    {{ session('success') }}
                </p>

            </div>

            <!-- Botón cerrar -->
            <button
                @click="show = false"
                class="ml-auto text-gray-400 hover:text-gray-600 transition">
                ✕
            </button>

        </div>

    </div>
    @endif


    <div class="flex justify-center mx-auto px-4 py-6">
        <div class="bg-white shadow-lg rounded-lg">
            <div class="border-b px-6 py-4 ">
                <h5 class="text-4xl font-semibold text-gray-700 mt-4 ">Clientes
                    <button class="mt-4 ml-4 text-sm px-4 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600 transition">
                        <a href="{{ route('clientes.create') }}">Agregar Cliente</a>
                    </button>
                </h5>



                <form action="{{ route('clientes.index') }}" method="GET" class="flex justify-end space-x-4">
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="inactivos" id="inactivos" value="1"
                            {{ request('inactivos') ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="inactivos" class="text-gray-700">Mostrar Inactivos ({{ $noDisponiblesCount }})</label>
                    </div>

                    <input type="text" name="search" placeholder="Buscar por nombre o email"
                        value="{{ old('search', request('search')) }}"
                        class="w-80 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 transition">
                        Buscar
                    </button>
                </form>


            </div>
            <hr class="divide-y divide-gray-400 mt-4">
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
                                <th class="px-4 py-2 text-left text-xl font-medium text-gray-600">Apellido</th>
                                <th class="px-4 py-2 text-left text-xl font-medium text-gray-600">Email</th>
                                <th class="px-4 py-2 text-left text-xl font-medium text-gray-600">Teléfono</th>
                                <th class="px-4 py-2 text-left text-xl font-medium text-gray-600">Dirección</th>
                                <th class="px-4 py-2 text-left text-xl font-medium text-gray-600">Estado</th>
                                <th class="px-4 py-2 text-left text-xl font-medium text-gray-600">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($clientes as $cliente)
                            <tr class="hover:bg-gray-100 transition">
                                <td hidden class="px-4 py-2 text-xl text-gray-700">{{ $cliente->id }}</td>
                                <td class="px-4 py-2 text-xl text-gray-700">{{ $cliente->nombre }}</td>
                                <td class="px-4 py-2 text-xl text-gray-700">{{ $cliente->apellido }}</td>
                                <td class="px-4 py-2 text-xl text-gray-700">{{ $cliente->email }}</td>
                                <td class="px-4 py-2 text-xl text-gray-700">{{ $cliente->telefono }}</td>
                                <td class="px-4 py-2 text-xl text-gray-700">{{ $cliente->direccion }}</td>
                                <td class="px-4 py-2 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xl font-semibold  text-center 
                                    {{ $cliente->estado == 'Activo' ? 'bg-green-300 text-green-700' : 'bg-red-300 text-red-700' }}">
                                        {{ $cliente->estado}}

                                    </span>
                                </td>
                                <td class="px-4 py-3 text-lg text-gray-700">
                                    <div class="flex space-x-3">
                                        <!-- Botón Editar -->
                                        <a href="{{ route('clientes.edit', $cliente->id) }}"
                                            class="inline-flex items-center px-3 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 transition">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z" clip-rule="evenodd" />
                                            </svg>

                                        </a>

                                        <!-- Botón cambiar estado de cliente -->
                                        @if(isset($cliente))
                                        <form id="clienteForm_delete" action="{{ route('clientes.toggleEstado', $cliente->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="button"
                                                onclick="document.getElementById('confirmStoreModal').classList.remove('hidden')"
                                                class="inline-flex items-center px-3 py-2 bg-red-500 text-white rounded-md shadow hover:bg-red-600 transition">
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
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
                                            No hay clientes registrados
                                        </p>

                                        <p class="text-gray-400 mt-2">
                                            Agrega un nuevo cliente para comenzar.
                                        </p>

                                    </div>

                                </td>
                            </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $clientes->links() }}
                </div>
            </div>
        </div>


    </div>




    <!-- Modal de confirmación -->
    <div id="confirmStoreModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-xl shadow-lg p-6 w-96">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Confirmar cambio de estado</h2>
            <p class="text-gray-600 mb-6">¿Estás seguro de que deseas cambiar el estado de este cliente?</p>
            <div class="flex justify-end space-x-3">
                <!-- Botón cancelar -->
                <button type="button"
                    onclick="document.getElementById('confirmStoreModal').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                    Cancelar
                </button>
                <!-- Botón confirmar -->
                @if(isset($cliente))
                <form action="{{ route('clientes.toggleEstado', $cliente->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="button"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                        onclick="document.getElementById('clienteForm_delete').submit()">
                        Confirmar
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>



</x-app-layout>