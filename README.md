<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Sistema de Gestión de Ventas

Aplicación desarrollada en **Laravel** para la gestión de ventas, clientes y productos.  
Incluye autenticación, panel administrativo y reportes básicos.

## 🚀 Requisitos

- PHP >= 8.1  
- Composer  
- MySQL o MariaDB  
- Node.js & NPM (para assets frontend)  
- Laravel >= 10.x  

## ⚙️ Instalación

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/JosueCast/Sistema-Gestion-Ventas.git
   cd Sistema-Gestion-Ventas

2. Instalar dependencias de PHP:
     ```bash
     composer install

3.Instalar dependencias de Node:
    ```bash
    npm install && npm run build

4.Configurar el archivo .env:
    Edita las variables de conexión a la base de datos y claves necesarias.

5.Ejecutar migraciones y seeders:
    php artisan migrate --seed
    
6.Levantar el servidor:
 php artisan serve && npm run serve

 📂 Estructura del proyecto
app/ → Lógica principal de Laravel

routes/ → Definición de rutas

resources/views/ → Vistas Blade

database/migrations/ → Migraciones de base de datos
👤 Autores
Josue Cast — Desarrollador principal


Este README es claro y profesional. Si quieres, podemos añadir una sección de **capturas de pantalla** o un **roadmap de funcionalidades futuras** para hacerlo más atractivo.  

¿Quieres que te prepare una versión con [capturas de pantalla](ca://s?q=Agregar_capturas_de_pantalla_al_README_Laravel) o con [roadmap de funcionalidades](ca://s?q=Agregar_roadmap_de_funcionalidades_al_README_Laravel)?

    
