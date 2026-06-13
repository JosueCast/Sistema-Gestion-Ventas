<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control de Categorías') }}
        </h2>
    </x-slot>

     <div class="flex justify-center mx-auto px-4 py-6">
        <div class="bg-white shadow-lg rounded-lg w-4/5 p-6">
            <div class="border-b px-6 py-4 ">
                <h5 class="text-4xl font-semibold text-gray-700 mt-4 ">Categorías
                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"  class="mt-4 ml-4 text-sm px-4 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600 transition">
                        Agregar Categoría
                    </button>
                </h5>



                <form action="{{ route('categorias.index') }}" method="GET" class="flex justify-end space-x-4">
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="inactivos" id="inactivos" value="1"
                            {{ request('inactivos') ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="inactivos" class="text-gray-700">Mostrar Inactivos ({{ $noDisponiblesCount }})</label>
                    </div>

                    <input type="text" name="search" placeholder="Buscar por nombre"
                        value="{{ old('search', request('search')) }}"
                        class="w-80 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 transition">
                        Buscar
                    </button>
                </form>


            </div>
            <hr class="divide-y divide-gray-400 mt-4">


              <div class="overflow-x-auto bg-gray-100 rounded shadow border p-4">
                {{-- Tabla de categorías --}}
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="p-3">Codigo</th>
                            <th class="p-3">Nombre</th>                            
                            <th class="p-3">Estado</th>                            
                            <th class="p-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorias as $categoria)
                        <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 font-mono text-sm text-gray-400">
                                    #{{ str_pad($categoria->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                            <td class="p-3 font-medium">
                                {{ $categoria->nombre }}
                            </td>
                        
                            <td class="p-3 font-medium">
                                    <span class="px-2 py-1 rounded-full text-xl font-semibold
                                        @if($categoria->estado == 'activo')
                                            bg-green-300 text-green-700
                                        @else($categoria->estado == 'inactivo')
                                            bg-red-300 text-red-700
                                        @endif">
                                        {{ $categoria->estado == 'activo' ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                           
                            <td class="p-3 flex gap-2">
                                <a href="{{ route('categorias.edit', $categoria) }}"
                                    class="text-blue-500 hover:underline mr-2 bg-blue-500 text-white border border-blue-500 rounded px-2 py-1">
                                     <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z" clip-rule="evenodd" />
                                            </svg>


                                </a>
                                <form id="delete-form-{{ $categoria->id }}" action="{{ route('categorias.toggleEstado', $categoria->id) }}"
                                    method="POST" class="inline">
                                    @csrf 
                                    @method('PATCH')
                                    <button 
                                        type="submit"
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
                                        No hay categorías registradas
                                    </p>

                                    <p class="text-gray-400 mt-2">
                                        Agrega una nueva categoría para comenzar.
                                    </p>

                                </div>

                            </td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>

            </div>
            {{-- Paginación --}}
            <div class="mt-4">{{ $categorias->links() }}</div>


        </div>



     @include('components.modalCreateCategoria')



   
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script >
        function openModal(){

        }
    </script>






</x-app-layout>