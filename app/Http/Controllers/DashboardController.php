<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Pedidos;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Producto::count();

    $totalCategories = Categoria::where('estado', 'activo')->count();

    $totalUsers = User::count();

    $totalClients = Cliente::count();

    $totalOrders = Pedidos::count();

    $outOfStockProducts = Producto::where('stock', 0)->count();

    $totalInventoryValue = Producto::sum(
        DB::raw('precio * stock')
    );

    $latestProducts = Producto::latest()->take(5)->get();

    return view('dashboard', compact(
        'totalProducts',
        'totalCategories',
        'totalUsers',
        'totalClients',
        'totalOrders',
        'outOfStockProducts',
        'totalInventoryValue',
        'latestProducts'
    ));
    }
}