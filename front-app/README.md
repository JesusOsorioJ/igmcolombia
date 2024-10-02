# IGM Frontend App

Esta es una aplicación frontend creada en Vue.js que se conecta a una API para gestionar y visualizar diferentes funcionalidades. A continuación, se detallan los pasos para configurar y ejecutar la aplicación en un entorno local.

## Requisitos previos

- **Node.js** versión 14.x o superior
- **Vue CLI** instalada globalmente:

    ```bash
    npm install -g @vue/cli
    ```

## Instalación

1. **Clonar el repositorio:**

    ```bash
    git clone https://github.com/JesusOsorioJ/igmfront.git
    cd proyecto
    ```

2. **Instalar dependencias de Laravel:**

    ```bash
    npm install
    ```

3. **Crear archivo .env:**

    Crear un archivo .env en la raíz del proyecto con el siguiente contenido:

    ```bash
    VUE_APP_API_URL=urldeapi
    ```

4. **Ejecución en entorno local:**
    Para iniciar la aplicación en modo de desarrollo, ejecutar:

    ```bash
    npm run serve
    ```
    La aplicación estará disponible en http://localhost:8080/.

## Scripts disponibles
### npm run serve: Inicia la aplicación en modo de desarrollo.
### npm run build: Genera la versión de producción de la aplicación.
### npm run lint: Ejecuta el linter para verificar el código.
