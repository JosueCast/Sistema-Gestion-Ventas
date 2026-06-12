<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

 <div class="py-10 bg-white-100 min-h-screen w-1/2 mx-auto">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Encabezado -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800">
                Dashboard
            </h1>
            <p class="text-gray-500 mt-2">
                Resumen General del Inventario
            </p>
        </div>

        <!-- Tarjetas principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6">

            <!-- Productos -->
            <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-blue-500 hover:shadow-xl transition">
                <p class="text-sm font-semibold text-gray-500 uppercase">
                    Productos
                </p>
                <h2 class="text-4xl font-bold text-gray-800 mt-2">
                    {{ $totalProducts }}
                </h2>
            </div>

            <!-- Categorías -->
            <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-xl transition">
                <p class="text-sm font-semibold text-gray-500 uppercase">
                    Categorías
                </p>
                <h2 class="text-4xl font-bold text-gray-800 mt-2">
                    {{ $totalCategories }}
                </h2>
            </div>

            <!-- Usuarios -->
            <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-purple-500 hover:shadow-xl transition">
                <p class="text-sm font-semibold text-gray-500 uppercase">
                    Usuarios
                </p>
                <h2 class="text-4xl font-bold text-gray-800 mt-2">
                    {{ $totalUsers }}
                </h2>
            </div>

            <!-- Agotados -->
            <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-red-500 hover:shadow-xl transition">
                <p class="text-sm font-semibold text-gray-500 uppercase">
                    Stock Bajo
                </p>
                <h2 class="text-4xl font-bold text-red-600 mt-2">
                    {{ $outOfStockProducts }}
                </h2>
            </div>

            <!-- Inventario -->
            <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-xl transition">
                <p class="text-sm font-semibold text-gray-500 uppercase">
                    Inventario Total
                </p>
                <h2 class="text-2xl font-bold text-gray-800 mt-2">
                    ${{ number_format($totalInventoryValue, 2) }}
                </h2>
            </div>

        </div>

        <!-- Panel inferior -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

            <!-- Resumen -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">
                    Resumen
                </h3>

                <div class="space-y-4">

                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        <span class="text-gray-600">
                            Productos registrados
                        </span>
                        <span class="font-bold text-blue-600">
                            {{ $totalProducts }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        <span class="text-gray-600">
                            Categorías registradas
                        </span>
                        <span class="font-bold text-green-600">
                            {{ $totalCategories }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl">
                        <span class="text-gray-600">
                            Usuarios registrados
                        </span>
                        <span class="font-bold text-purple-600">
                            {{ $totalUsers }}
                        </span>
                    </div>

                </div>
            </div>

            <!-- Inventario -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-6">
                    Estado General del Inventario
                </h3>

                <div class="grid md:grid-cols-2 gap-6">

                    <div class="bg-green-50 border border-green-200 rounded-xl p-5">
                        <p class="text-green-700 font-semibold">
                            Productos Disponibles
                        </p>
                        <h2 class="text-4xl font-bold text-green-600 mt-2">
                            {{ $totalProducts - $outOfStockProducts }}
                        </h2>
                    </div>

                    <div class="bg-red-50 border border-red-200 rounded-xl p-5">
                        <p class="text-red-700 font-semibold">
                            Productos Agotados
                        </p>
                        <h2 class="text-4xl font-bold text-red-600 mt-2">
                            {{ $outOfStockProducts }}
                        </h2>
                    </div>

                    <div class="md:col-span-2 bg-yellow-50 border border-yellow-200 rounded-xl p-5">
                        <p class="text-yellow-700 font-semibold">
                            Valor Total del Inventario
                        </p>
                        <h2 class="text-5xl font-bold text-yellow-600 mt-2">
                            ${{ number_format($totalInventoryValue, 2) }}
                        </h2>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
</x-app-layout>
