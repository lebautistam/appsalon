# Aplicación para control de citas salón de belleza

![image](https://github.com/lebautistam/appsalon/assets/102302953/44a15cc3-a9c6-4c01-8917-c3e869752ba9)


## Descripción

Url proyecto: https://salonapp-lebautistam.000webhostapp.com/

Proyecto PHP, JavaScript, HTML, CSS (sass, gulp), composer
El proyecto cuenta con panel administrativo y para el usuario, de tal manera que el cliente podrá reservar su cita, con los servicios y fecha a gusto, el administrador podrá ver las citas reservadas para tener un control dinámico y organizar el tiempo.

## Instalación

Sigue estos pasos para instalar y configurar el proyecto en tu máquina local.

### Requisitos

Asegúrate de tener instalados los siguientes programas:

- Editor de código
- Servidor apache u otro y Base de datos

### Pasos de Instalación

1. Clona este repositorio:

    ```bash
    git clone https://github.com/lebautistam/appsalon.git
    ```

2. Navega al directorio del proyecto:

    ```bash
    cd appsalon
    ```

3. Instala las dependencias:

    ```bash
    npm install
    composer install
    ```

4. Configura el archivo de entorno: con lo necesario para la base de datos y envió de Email

    ```bash
    includes/.env
    ```

    Ajusta las variables de entorno en el archivo `.env` según sea necesario.
5. Crea la base de datos

   Dejaré el dump cargado en el repositorio para que lo ejecutes en el servidor de base de datos mysql, la base de datos debe llamarse _appsalon_
   
6. Inicia la aplicación:

    ```bash
    npm run gulp
    ```

    Visita `http://localhost` en tu navegador, poner el puerto si usas ej, ':3000'.

## Uso

Abre la url principal '/' aparecerá para iniciar sesión, si no tienes cuenta crea una, se enviará un email, sin embargo el funcionamiento de envió de emails no funciona, solo con los servidores de prueba como Mailtrap, por lo cual no se podrá confirmar la cuenta, para esto, puede cambiar el indicador de confirmado en la tabla tab_genera_usuari
por 1 y dejar el token en blanco, tiene un sistema de cambio de contraseña por email también.

![Screenshot_1](https://github.com/lebautistam/appsalon/assets/102302953/080c04ad-c7ab-40a3-b3f9-c4b8ee13a49c)

Una vez puedas iniciar sesión y autenticarte (no se permniten correos repetidos) ya sea como administrador o cliente te saldrá un panel para que hagas el debido proceso y pruebes el aplicativo, en la tabla de usuarios ya hay un usuario administrador.
#### usuario: correo@correo.com
#### clave: 12345678

y uno 
#### cliente: correo1@correo.com
#### clave: 123456

##### El cliente tiene tres pestañas 
- _servicios_, en la cual elegirá que servicios quiere tomar.
- _Información cita_, donde se podrá elegir la fecha y hora de la cita. no se pueden elegir días anteriores a la fecha actual.
- _Resumen de la cita_, Con los precios de cada servicio, fecha y hora.

##### El administrador puede ver tres pestañas

- _Ver citas_, donde podrá filtrar por fechas para ver que días tiene citas para atender.
- _Ver servicios_, se listarán todos los servicios que tiene en oferta, podrá actualizarlos y eliminarlos esto se hace mediante _(API)_.
- _Crear servicio_, podrá crear nuevos servicios.

