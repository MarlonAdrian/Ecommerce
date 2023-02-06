# Backend: Ecommerce para la venta de Equipos computacionales - mamOlbin
Antes de interactuar con la aplicación ya sea en el sitio web, hacer uso del código para alguna mejora, etcétera, usted deberá tener en cuenta algunas consideraciones. Cualquiera que fuese el caso, se exige que se tenga instalado previamente un editor de código fuente, de preferencia Visual Studio Code, en donde usted pueda actualizar y/o modificar el código. Asimismo, de algunas otras herramientas que servirán para un mejor funcionamiento y desarrollo.

**Se sugiere que obligatoriamente deba tener todas las herramientas si se hará uso de la misma.**

**1. Descarga de proyecto de GitHub**
   - Es importante realizar la descarga del proyecto para tener acceso a los recursos ya elaborados
   - **Nota: La rama a descargarse deberá ser el del Sprint6, debido a que esa rama es la que posee todo el código fuente del proyecto que ha sido desarrollado.**
   - En el siguiente enlace se encuentra infromación de cómo realizar la descarga de un proyecto de GitHub según su rama: 
        *https://www.cristianmonroy.com/2021/04/aprende-a-descargar-archivos-individuales-de-github.html*

**2. Descarga de proyecto de Visual Studio**
   - Sea cual fuese su sistema operativo se puede descargar el editor de código mediante el siguiente enlace: 
        *https://code.visualstudio.com/download*

**3. Descarga de Git**
   - De la misma forma se debe descargar la herramienta de Git depedendiendo del sistema operativo del ordenador para que trabaje conjuntamente con GitHub: 
        *https://git-scm.com/book/es/v2/Inicio---Sobre-el-Control-de-Versiones-Instalaci%C3%B3n-de-Git*

**4. Descarga de Node.js**
   - Al igual que los pasos anteriores se recomienda la instalacción de otra herramienta que servirá para la instalación de librerias: 
        *https://nodejs.org/es/*

**5. Descarga de XAMPP**
   - La instalación de Xampp: 
        *https://www.apachefriends.org/es/index.html*
   
**6. Descarga de Composer**
   - Composer es de gran utilidad dado que trabaja en conjunto con laravel: 
        *https://getcomposer.org/download/*

**7. Descarga de Laravel**
   - Puede descargar Laravel en su ordenador con el siguiente comando, debido al paso anterior de la descarga de Composer, agilizando la descarga
     - *composer global require laravel/installer*
   - Sino con la documentación oficial de Laravel: *https://laravel.com/docs/7.x#installing-laravel*

**8. Creación y Modificación archivo *.env***
   - Por seguridad GitHub evita el alojamiento y descarga del archivo *.env*, debido a información sensible que se almacena allí.
   - Es necesario la creación de un archivo *.env* en la carpeta raíz del proyecto.
   - En el archivo *.env.example* se encuentra un modelo de los campos que deberán completarse para trabajar con el proyecto localmente. Por ejemplo, campos que deberán editarse para una base de datos a elección:
     - DB_CONNECTION
     - DB_HOST
     - DB_PORT
     - DB_DATABASE
     - DB_USERNAME
     - DB_PASSWORD
   - De la misma forma, campos para el envío de correo electrónico:
     - MAIL_DRIVER
     - MAIL_HOST
     - MAIL_PORT
     - MAIL_USERNAME
     - MAIL_PASSWORD
     - MAIL_ENCRYPTION   
   - **NOTA: SI NO MODIFICA ESTOS CAMPOS NO PODRÁ AVANZAR A LOS SIGUIENTES PASOS**  

**9. Obtener archivo vendor del proyecto original con Composer*
   - Ingrese el comando: 
     - *composer install*

**10. Obtener dependencias y librerias del proyecto original**
   - Ingrese el comando: 
     - *npm install*
     
**11. Migración de datos a la base de datos ingresada en el paso 8**
   - Ingrese el comando: 
     - *php artisan migrate*
     - *php artisan migrate:refresh --seed*
     
**12. Creación token para JWT hacia el archivo *.env***
   - Ingrese el comando: 
     - *php artisan jwt:secret*     

**13. Ejecucicón VITE en el proyecto para visualización**
   - Ingrese el comando: 
     - *npm run dev*     
     
**14. Migración de datos a la base de datos ingresada en el paso 8**
   - Ingrese el comando: 
    - *php artisan serve*
     - Una vez ingresado el comando anterior deberá abrir su navegador e ingresar el puerto que le indica. Va a ver una imagen como la siguiente, debe dar clic en *Generate App Key*. Esto sucede debido a que se descargó el proyecto de GitHub y el valor de esta App Key se eliminó, por lo que aquí solamente está creando uno nuevo.
        - ![imagen](https://user-images.githubusercontent.com/66731201/216922100-74f7fce9-3bf2-483f-96fe-c4575684c03c.png)

 **15. Ya se puede hacer uso del proyecto**  
 
 **16. Utilice la herramienta *Postman* para comenzar a interactuar con el proyecto**       
