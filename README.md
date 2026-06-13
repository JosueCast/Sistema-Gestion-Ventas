<p align="center">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
    <a href="https://github.com/JosueCast/Sistema-Gestion-Ventas"><img src="https://img.shields.io/badge/versión-1.0.0-blue" alt="Versión"></a>
    <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-10.x-red" alt="Laravel 10.x"></a>
    <a href="https://php.net"><img src="https://img.shields.io/badge/PHP-8.1+-777BB4" alt="PHP 8.1+"></a>
    <a href="https://mysql.com"><img src="https://img.shields.io/badge/MySQL-8.0+-4479A1" alt="MySQL 8.0+"></a>
    <a href="LICENSE"><img src="https://img.shields.io/badge/licencia-MIT-green" alt="Licencia MIT"></a>
</p>

# 🛒 Sistema de Gestión de Ventas

**Sistema web completo** desarrollado con Laravel para administrar ventas, clientes, productos y usuarios con diferentes roles.  
Ideal para pequeños negocios que necesitan digitalizar su punto de venta y control de inventario.

---

## 📖 ¿Qué hace este software? (Lógica del negocio)

El sistema permite gestionar el ciclo completo de una venta:

1.  **👤 Gestión de usuarios y roles**  
    - Dos tipos de usuarios: `admin` (acceso total) y `vendedor` (solo ventas y clientes).  
    - Los usuarios inician sesión con credenciales seguras.

2.  **📦 Gestión de productos**  
    - Registrar productos con nombre, precio, stock y categoría.  
    - Control de inventario: el stock se actualiza automáticamente al vender.

3.  **👥 Gestión de clientes**  
    - Base de datos de clientes con datos de contacto.  
    - Historial de compras por cliente.

4.  **🧾 Proceso de venta**  
    - El vendedor selecciona un cliente y agrega productos al carrito.  
    - El sistema calcula el total y valida el stock disponible.  
    - Al confirmar, se genera un pedido, se resta el stock y se guarda el historial.

5.  **📊 Reportes y dashboards**  
    - Panel de control con ventas del día, productos más vendidos, etc.  
    - Reportes filtrados por fecha, cliente o vendedor.

6.  **🔒 Seguridad**  
    - Protección de rutas por autenticación y roles.  
    - Validación de datos en servidor y cliente.

---

## 🚀 Requisitos previos

- PHP >= 8.1  
- Composer  
- MySQL o MariaDB  
- Node.js y NPM  
- Laravel 10.x

---

## ⚙️ Instalación y configuración

Sigue estos pasos para poner el sistema en marcha:

```bash
# 1. Clonar el repositorio
git clone https://github.com/JosueCast/Sistema-Gestion-Ventas.git
cd Sistema-Gestion-Ventas

# 2. Instalar dependencias de PHP
composer install

# 3. Instalar dependencias de Node.js y compilar assets
npm install && npm run build

# 4. Copiar archivo de entorno y generar clave
cp .env.example .env
php artisan key:generate

# 5. Configurar base de datos en el archivo .env
# DB_DATABASE=sistema_ventas
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Ejecutar migraciones y seeders (crea tablas + datos de prueba)
php artisan migrate --seed

# 7. Iniciar servidor de desarrollo
php artisan serve

# 8. En otra terminal, compilar assets en tiempo real (opcional)
npm run dev



📁 Sistema-Gestion-Ventas
├── app/
│   ├── Http/Controllers/     → Lógica de negocio (ventas, productos, clientes)
│   ├── Models/               → Modelos Eloquent (User, Producto, Venta, Cliente, Rol)
│   └── Policies/             → Reglas de autorización
├── database/
│   ├── migrations/           → Estructura de tablas
│   └── seeders/              → Datos iniciales (roles, admin, etc.)
├── resources/views/          → Vistas Blade (interfaz de usuario)
├── routes/
│   ├── web.php               → Rutas principales (protegidas por auth y roles)
│   └── api.php               → Endpoints (si aplica)
└── public/                   → Frontend compilado (CSS, JS, imágenes)

👨‍💻 Autores
Josué Cast – Desarrollador principal 

🗺️ Roadmap (próximas funcionalidades)
Módulo de proveedores y compras

Facturación electrónica

Gráficos estadísticos con Chart.js

Exportación de reportes a Excel/PDF

Módulo de caja chica / gastos
