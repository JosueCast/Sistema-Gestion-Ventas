<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control de Edición de Categorías') }}
        </h2>
    </x-slot>

    
    <div class="flex justify-center mx-auto w-full px-4 py-6">
        <div class="bg-white shadow-lg rounded-lg px-4 py-6 w-3/4">
            <div class="border-b px-6 py-4 ">
                <h5 class="text-4xl font-semibold text-gray-700 mt-4 ">Actualizar Categoría</h5>
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

                <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="nombre" class="block text-xl font-medium text-gray-700 ">Nombre</label>
                        <input placeholder="Ingrese el nombre" type="text" name="nombre" id="nombre" value="{{ old('nombre', $categoria->nombre) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('nombre')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="estado" class="block text-xl font-medium text-gray-700">Estado</label>
                        <select name="estado" id="estado" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="activo" {{ old('estado', $categoria->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ old('estado', $categoria->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                      
                  
                  
                    <div class="flex justify-space-between">
                        <button type="submit"
                            class="px-4 py-2 bg-green-500 text-white rounded-md text-lg text-semibold shadow hover:bg-green-600 transition"
                            >
                            Guardar Categoría
                        </button>
                        <button type="button" class="ml-4 px-4 py-2 bg-gray-500 text-white rounded-md text-lg text-semibold shadow hover:bg-gray-600 transition"
                        >
                            <a href="{{ route('categorias.index') }}">Cancelar</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>