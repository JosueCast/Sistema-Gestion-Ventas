<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
     class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50"
     data-modal-backdrop="static">
  <div class="relative p-4 w-full max-w-md">
    <!-- Modal content -->
    <div class="relative bg-white border rounded-lg shadow-lg p-6">
      <!-- Modal header -->
      <div class="flex items-center justify-between border-b pb-4">
        <h3 class="text-lg font-medium text-gray-900">
          Crear Nueva Categoría
        </h3>
        <button type="button"
                class="text-gray-500 hover:text-gray-700 rounded-lg text-sm w-9 h-9 flex justify-center items-center"
                data-modal-hide="crud-modal">
          ✕
        </button>
      </div>
      <div class="p-3">
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

                <form action="{{ route('categorias.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="nombre" class="block text-xl font-medium text-gray-700 ">Nombre</label>
                        <input placeholder="Ingrese el nombre" type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('nombre')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="estado" class="block text-xl font-medium text-gray-700">Estado</label>
                        <select name="estado" id="estado" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="activo" >Activo</option>
                            <option value="inactivo">Inactivo</option>
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
</div>