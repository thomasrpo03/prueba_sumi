# Prueba Técnica

Este es un proyecto de demostración para una prueba técnica utilizando Laravel. La aplicación incluye funcionalidades de autenticación, manejo de tareas y productos con sus categorías, un sistema de búsqueda y filtrado.

## Requisitos

-   PHP >= 8.2.12
-   Composer
-   Node.js y npm
-   MySQL

## Instalación

### Paso 1: Clonar el Repositorio

```bash
git clone https://github.com/tu-usuario/tu-repositorio.git
cd tu-repositorio
```

### Paso 2: Instalar las dependencias

```bash
composer install
npm install
npm run dev
```

### Paso 3: Configurar las variables de entorno

Copiar el archivo `.env.example` a `.env` y configurar las crendenciales de la base de datos

```makefile
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

### Paso 4: Generar la Clave de la Aplicación

```bash
php artisan key:generate
```

### Paso 5: Migrar y Sembrar la Base de Datos

Ejecutar las migraciones y los seeders para configurar la base de datos con los datos iniciales

```bash
php artisan migrate --seed
```

### Paso 6: Iniciar el Servidor de Desarrollo

```bash
php artisan serve
```

Luego, abrir el navegador y visitar la ruta `http://127.0.0.1:8000`

----