<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control de Clientes') }}
        </h2>
    </x-slot>

    <div class="flex justify-center mx-auto w-full px-4 py-6">
        <div class="bg-white shadow-lg rounded-lg px-4 py-6 w-3/4">
            <div class="border-b px-6 py-4 ">
                <h5 class="text-4xl font-semibold text-gray-700 mt-4 ">Agregar Cliente</h5>
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
                <!-- Formulario para agregar un nuevo cliente -->

                    <form id="clienteForm" action="{{ route('clientes.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="nombre" class="block text-xl font-medium text-gray-700 " >Nombre</label>
                            <input placeholder="Ingrese el nombre" type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('nombre')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                        </div>
                        <div>
                            <label for="apellido" class="block text-xl font-medium text-gray-700">Apellido</label>
                            <input placeholder="Ingrese el apellido" type="text" name="apellido" id="apellido" value="{{ old('apellido') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('apellido')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-xl font-medium text-gray-700">Email</label>
                            <input placeholder="Ingrese el email" type="email" name="email" id="email" required value="{{ old('email') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                        </div>
                        <div>
                            
                            <label for="telefono" class="block text-xl font-medium text-gray-700">Teléfono</label>
                            <input placeholder="Ingrese el teléfono" maxlength="8" minlength="8"  type="text" name="telefono" id="telefono" value="{{ old('telefono') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"> 
                                @error('telefono')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p> 
                                @enderror
                        </div>
                        <div>
                            <label for="direccion" class="block text-xl font-medium text-gray-700">Dirección</label>
                            <textarea
                                name="direccion"
                                id="direccion"
                                rows="4"
                                value="{{ old('direccion') }}"
                                placeholder="Ingrese la dirección"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                transition duration-200 resize-none"></textarea>
                                @error('direccion')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                        </div>
                        <div hidden>
                            <label for="estado" class="block text-xl font-medium text-gray-700">Estado</label>
                            <select name="estado" id="estado" required value="Activo"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="flex justify-space-between">
                            <button type="button" 
        onclick="document.getElementById('confirmStoreModal').classList.remove('hidden')"
        class="px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                                Guardar Cliente
                            </button>
                            <button  type="button"class="ml-4 px-4 py-2 bg-gray-500 text-white rounded-md text-lg text-semibold shadow hover:bg-gray-600 transition">
                                <a href="{{ route('clientes.index') }}">Cancelar</a>    
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
        <p class="text-gray-600 mb-6">¿Estás seguro de que deseas crear este cliente?</p>
        <div class="flex justify-end space-x-3">
            <!-- Botón cancelar -->
            <button type="button" 
                onclick="document.getElementById('confirmStoreModal').classList.add('hidden')"
                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                Cancelar
            </button>
            <!-- Botón confirmar -->
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
                <button type="button" 
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition"
                                    onclick="document.getElementById('clienteForm').submit()">
                    Confirmar
                </button>
            </form>
        </div>
    </div>
</div>


</x-app-layout>