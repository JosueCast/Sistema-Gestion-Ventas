<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control de Creacion de Productos') }}
        </h2>
    </x-slot>

    <!-- Contenido principal -->
        <div class="flex justify-center mx-auto w-full px-4 py-6">
        <div class="bg-white shadow-lg rounded-lg px-4 py-6 w-1/4">
            <div class="border-b px-6 py-4 ">
                <h5 class="text-4xl font-semibold text-gray-700 mt-2 ">Agregar Producto</h5>
                

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
                <!-- Formulario para agregar un nuevo producto -->

                    <form id="productoForm" action="{{ route('productos.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="nombre" class="block text-xl font-medium text-gray-700 " >Nombre del producto</label>
                            <input placeholder="Ingrese el nombre" type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('nombre')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                        </div>
                        <div>
                            <label for="descripcion" class="block text-xl font-medium text-gray-700">Breve Descripción</label>
                            <textarea placeholder="Ingrese la descripción" name="descripcion" id="descripcion" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                        </div>
                       
                        <div class="flex justify-space-between">
                             <div class=" mr-2" >
                            <label for="precio" class="block text-xl font-medium text-gray-700">Precio</label>
                            <input placeholder="Ingrese el precio" type="number" name="precio" id="precio" value="{{ old('precio') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('precio')
                                    <p class="mt-2 text-sm text-red-600">{{ $message}}</p>
                                @enderror
                        </div>
                        <div>
                            <label for="stock" class="block text-xl font-medium text-gray-700">Stock</label>
                            <input placeholder="Ingrese el stock" type="number" name="stock" id="stock" value="{{ old('stock') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('stock')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                        </div>  
                        </div>


                       <div class="flex justify-space-between">
                         <div hidden class="px-2" >
                            <label for="estado" class="block text-xl font-medium text-gray-700">Estado</label>
                            <select name="estado" id="estado" required value="Disponibles"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Disponibles">Disponible</option>
                                <option value="No Disponibles">No Disponible</option>
                            </select>
                        </div>

                        <div class="px-2 flex items-center " >
                            <label for="categoria_id" class="block text-xl font-medium text-gray-700">Categoría</label>
                            <select name="categoria_id" id="categoria_id" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Activo">Selecciona una categoria</option>
                                @forelse($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @empty
                                    <option value="" disabled>No hay categorías disponibles</option>
                                @endforelse
                                
                            </select>
                           <button 
                                data-modal-target="crud-modal"
                                data-modal-toggle="crud-modal"
                                class="ml-2 px-2 py-2  bg-blue-600 text-white rounded">
                            
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z" clip-rule="evenodd"/>
                            </svg>

                        </button>
                           
                            
                        </div>
                       </div>

                      

                      
                        <div class="flex justify-space-between">
                            <button type="button" 
                                onclick="document.getElementById('confirmStoreModal').classList.remove('hidden')"
                                class="px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                                Guardar Producto
                            </button>
                            <button  type="button"class="ml-4 px-4 py-2 bg-gray-500 text-white rounded-md text-lg text-semibold shadow hover:bg-gray-600 transition">
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
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Confirmar creación</h2>
        <p class="text-gray-600 mb-6">¿Estás seguro de que deseas crear este producto?</p>
        <div class="flex justify-end space-x-3">
            <!-- Botón cancelar -->
            <button type="button" 
                onclick="document.getElementById('confirmStoreModal').classList.add('hidden')"
                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                Cancelar
            </button>
            <!-- Botón confirmar -->
            <form action="{{ route('productos.store') }}" method="POST">
                @csrf
                <button type="button" 
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition"
                    onclick="document.getElementById('productoForm').submit()">
                    Confirmar
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Modal para crear categoría REUTILIZABLE EN PRODUCTOS Y CATEGORIAS--}}
@include('components.modalCreateCategoria')



</x-app-layout>