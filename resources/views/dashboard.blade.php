<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Dashboard') }} -->
            <p class="text-gray-800 mt-2">
                Resumen General del Inventario
            </p>
        </h2>
    </x-slot>

    <div class="py-10 bg-white-100 min-h-screen w-full mx-auto">





        <div class="container mx-auto px-4 py-6 w-full">
            <div class="flex items-center justify-center mb-6 gap-6">
                <!-- Total de Ventas -->
                <div class="flex max-w-sm rounded-2xl p-6 rounded-2xl shadow-md p-6 border-l-4 border-green-500  rounded-base shadow-xs transition bg-white hover:shadow-lg hover:scale-105 hover:bg-gray-300">

                    <div class=" ">
                        <a href="#">
                            <h5 class="mb-2 text-xl text-gray-500 tracking-tight text-heading font-body">Total de Ventas</h5>
                        </a>
                        <p class="mb-3 text-body text-2xl font-bold font-sans">${{$totalVentas}}</p>
                    </div>


                    <svg
                        class="w-20 h-20 mb-3 text-body float-right 
                            transition-transform duration-300 ease-in-out 
                            hover:rotate-12 hover:scale-110 hover:text-brown-500"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

                <!-- categoria con mas productos -->
                <div class="flex max-w-sm rounded-2xl p-6 rounded-2xl shadow-md p-6 border-l-4 border-purple-500  rounded-base shadow-xs transition bg-white hover:shadow-lg hover:scale-105 hover:bg-gray-300">

                    <div class=" ">
                        <a href="#">
                            <h5 class="mb-2 text-xl text-gray-500 tracking-tight text-heading font-body">Categoría con Más Productos</h5>
                        </a>
                        <p class="mb-3 text-body text-2xl font-bold font-sans">{{$categoriaMasProductos->nombre}}
                        </p>
                        <p class="text-sm text-gray-500 font-normal"> Productos: {{$categoriaMasProductos->productos_count}} </p>
                    </div>


                    <svg
                        class="w-20 h-20 mb-3 text-body float-right 
                            transition-transform duration-300 ease-in-out 
                            hover:rotate-12 hover:scale-110 hover:text-brown-500"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor">
                        <path fill-rule="evenodd" d="M6 5a2 2 0 0 1 2-2h4.157a2 2 0 0 1 1.656.879L15.249 6H19a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2v-5a3 3 0 0 0-3-3h-3.22l-1.14-1.682A3 3 0 0 0 9.157 6H6V5Z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M3 9a2 2 0 0 1 2-2h4.157a2 2 0 0 1 1.656.879L12.249 10H3V9Zm0 3v7a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-7H3Z" clip-rule="evenodd" />
                    </svg>
                </div>

                <div class="flex max-w-sm rounded-2xl p-6 rounded-2xl shadow-md p-6 border-l-4 border-red-900  rounded-base shadow-xs transition bg-white hover:shadow-lg hover:scale-105 hover:bg-gray-300">

                    <div class=" ">
                        <a href="#">
                            <h5 class="mb-2 text-xl text-gray-500   tracking-tight text-heading font-body">Valor de Inventario</h5>
                        </a>
                        <p class="mb-3 text-body text-2xl font-bold font-sans">$ {{ number_format($totalInventoryValue, 2) }}</p>
                    </div>


                    <svg
                        class="w-20 h-20 mb-3 text-body float-right 
                            transition-transform duration-300 ease-in-out 
                            hover:rotate-12 hover:scale-110 hover:text-brown-500"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor">
                        <path fill="currentColor" d="M3.69869 6.31701C2.56717 5.02384 3.48553 3 5.20384 3H18.7547c1.7316 0 2.6449 2.05088 1.4866 3.33793L17.47 9.34198s-.4632-.20588-.6184-.24042c-.1551-.03453-.488-.10604-.9206-.10604-.9034 0-2.138.66073-2.5716 1.73108-1.3256.8485-1.6921 1.8133-1.7929 2.0078-.1009.1944-.2618.5312-.3399 1.2148-.0781.6836 0 1.6055.5235 2.4688-.0721.0626-.2383.289-.3321.4375-.0937.1484-.5898.875-.3515 2.1445-.1993 0-.6387-.158-.92-.4393l-.70708-.7071c-.28131-.2814-.43934-.6629-.43934-1.0607v-4.4172L3.69869 6.31701Z" />
                        <path fill="currentColor" fill-rule="evenodd" d="M16.0604 11c.5523 0 1 .4477 1 1v.1013c.6366.1591 1.2184.4937 1.668.9715.3784.4022.3592 1.0351-.0431 1.4135-.4022.3785-1.0351.3592-1.4135-.043-.1902-.2021-.4506-.3504-.7488-.4139-.0363-.0077-.0722-.0174-.1074-.0292-.0543-.018-.1098-.0317-.1658-.041-.0614.0117-.1247.0179-.1894.0179-.063 0-.1245-.0058-.1843-.017-.0784.0136-.1554.0355-.2292.0658-.1976.0812-.3513.2132-.4504.3673.0006.002.0013.0042.002.0064.0138.0431.0516.1195.1396.2154.1806.1971.4983.3934.8907.4835.746.1712 1.4369.5572 1.9192 1.0838.476.5197.8461 1.3054.5891 2.1704-.0136.0459-.0305.0907-.0506.1342-.3123.6768-.8768 1.2008-1.5636 1.483-.0208.0085-.0416.0168-.0625.0248V20c0 .5523-.4477 1-1 1-.5271 0-.9589-.4077-.9973-.9249-.0154-.0046-.0308-.0093-.0462-.0141-.6707-.1541-1.2837-.502-1.7506-1.0062-.3752-.4053-.3509-1.038.0544-1.4132.4052-.3752 1.0379-.3508 1.4131.0544.1903.2055.4527.3566.754.4209.0359.0077.0713.0173.1061.0289.0754.025.1531.0416.2315.0499.0753-.0181.154-.0277.235-.0277.0421 0 .0836.0026.1244.0076.0608-.0134.1204-.032.1781-.0557.1979-.0813.3518-.2135.451-.368l-.001-.0032c-.0136-.0424-.0513-.1189-.1398-.2156-.1817-.1984-.5007-.3955-.8919-.4854-.7448-.171-1.4351-.5549-1.9176-1.0814-.4776-.5211-.8432-1.304-.5924-2.167.0138-.0477.0312-.0943.052-.1394.312-.6773.8766-1.2017 1.5637-1.4839.0573-.0236.1151-.0453.1735-.0653V12c0-.5523.4477-1 1-1Z" clip-rule="evenodd" />
                    </svg>

                </div>

            </div>


            <!-- Tarjetas secundarias -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                <!-- Productos -->
                <div class="flex max-w-sm rounded-2xl p-6 rounded-2xl shadow-md p-6 border-l-4 border-indigo-500  rounded-base shadow-xs transition bg-white hover:shadow-lg hover:scale-105 hover:bg-gray-300">

                    <div class=" ">
                        <a href="#">
                            <h5 class="mb-2 text-xl text-gray-500 tracking-tight text-heading font-body">Total de Productos</h5>
                        </a>
                        <p class="mb-3 text-body text-2xl font-bold font-sans">${{$totalProducts}}</p>
                    </div>


                    <svg
                        class="w-16 h-16 mb-3 text-body float-right 
                            transition-transform duration-300 ease-in-out 
                            hover:rotate-12 hover:scale-110 hover:text-brown-500"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor">
                        <path fill-rule="evenodd" d="M4.857 3A1.857 1.857 0 0 0 3 4.857v4.286C3 10.169 3.831 11 4.857 11h4.286A1.857 1.857 0 0 0 11 9.143V4.857A1.857 1.857 0 0 0 9.143 3H4.857Zm10 0A1.857 1.857 0 0 0 13 4.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 9.143V4.857A1.857 1.857 0 0 0 19.143 3h-4.286Zm-10 10A1.857 1.857 0 0 0 3 14.857v4.286C3 20.169 3.831 21 4.857 21h4.286A1.857 1.857 0 0 0 11 19.143v-4.286A1.857 1.857 0 0 0 9.143 13H4.857ZM18 14a1 1 0 1 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0-2h-2v-2Z" clip-rule="evenodd" />


                    </svg>
                </div>

                <!-- Categorías -->
                <div class="flex max-w-sm rounded-2xl p-6 rounded-2xl shadow-md p-6 border-l-4 border-pink-500  rounded-base shadow-xs transition bg-white hover:shadow-lg hover:scale-105 hover:bg-gray-300">

                    <div class=" ">
                        <a href="#">
                            <h5 class="mb-2 text-xl text-gray-500 tracking-tight text-heading font-body">Total de Categorías</h5>
                        </a>
                        <p class="mb-3 text-body text-2xl font-bold font-sans">{{$totalCategories}}</p>
                    </div>
                    <svg
                        class="w-16 h-16 mb-3 text-body float-right 
                            transition-transform duration-300 ease-in-out 
                            hover:rotate-12 hover:scale-110 hover:text-brown-500"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor">
                        <path d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z" />
                        <path d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z" />
                    </svg>
                </div>

                <!-- Usuarios -->
                <div class="flex max-w-sm rounded-2xl p-6 rounded-2xl shadow-md p-6 border-l-4 border-yellow-500  rounded-base shadow-xs transition bg-white hover:shadow-lg hover:scale-105 hover:bg-gray-300">

                    <div class=" ">
                        <a href="#">
                            <h5 class="mb-2 text-xl text-gray-500 tracking-tight text-heading font-body">Total de Usuarios</h5>
                        </a>
                        <p class="mb-3 text-body text-2xl font-bold font-sans">{{$totalUsers}}</p>
                    </div>
                    <svg
                        class="w-16 h-16 mb-3 text-body float-right 
                            transition-transform duration-300 ease-in-out 
                            hover:rotate-12 hover:scale-110 hover:text-brown-500"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd" />
                    </svg>
                </div>

                <!-- Para reponer -->
                <div class="flex max-w-sm rounded-2xl p-6 rounded-2xl shadow-md p-6 border-l-4 border-orange-500  rounded-base shadow-xs transition bg-white hover:shadow-lg hover:scale-105 hover:bg-gray-300">

                    <div class="">
                        <a href="#">
                            <h5 class="mb-2 text-xl text-gray-500 tracking-tight text-heading font-body">Productos con Stock Bajo</h5>
                        </a>
                        <p class="mb-3 text-body text-2xl font-bold font-sans">{{$stockLowProducts}}</p>
                    </div>
                    <svg
                        class="w-16 h-16 mb-3 text-body float-right 
                            transition-transform duration-300 ease-in-out 
                            hover:rotate-12 hover:scale-110 hover:text-brown-500"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd" />
                    </svg>
                </div>

                <!-- mas tarjetas si se necesitan -->

            </div>

            <!-- Panel inferior -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

                <!-- Resumen -->
                <div class="bg-white rounded-2xl shadow-md p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">
                        Resumen
                    </h3>

                    <div class="space-y-4">

                        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl hover:bg-blue-200 transition">
                            <span class="text-gray-600">
                                Productos registrados
                            </span>
                            <span class="font-bold text-blue-600">
                                {{ $totalProducts }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl hover:bg-green-200 transition">
                            <span class="text-gray-600">
                                Categorías registradas
                            </span>
                            <span class="font-bold text-green-600">
                                {{ $totalCategories }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl hover:bg-purple-200 transition">
                            <span class="text-gray-600">
                                Usuarios registrados
                            </span>
                            <span class="font-bold text-purple-600">
                                {{ $totalUsers }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl hover:bg-orange-200 transition">
                            <span class="text-gray-600">
                                Clientes registrados
                            </span>
                            <span class="font-bold text-orange-600">
                                {{ $totalClients }}
                            </span>
                        </div>
                        <hr class="my-4 border-gray-300">
                        <h4 class="text-lg font-semibold text-gray-700">
                            Último Producto Agregado
                        </h4>

                        <div class="bg-gray-100 p-4 rounded-xl  transition shadow-sm">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-gray-200 text-left">
                                        <th class="p-2">Nombre</th>
                                        <th class="p-2">Precio</th>
                                        <th class="p-2">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="p-2 font-medium">
                                            {{ $latestProduct->nombre }}
                                        </td>
                                        <td class="p-2 font-medium">
                                            ${{ number_format($latestProduct->precio, 2) }}
                                        </td>
                                        <td class="p-2 font-medium bg">
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $latestProduct->estado == 'Disponibles' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $latestProduct->estado }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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

                        <hr class="md:col-span-2  border-gray-300">
                        <p class="md:col-span-2 text-gray-600">
                            Gráfico de distribución de productos por categoría
                        </p>

                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>