# moocucc 

Hecho en:
Laravel Version 4.2 

##Instrucciones de instalación

Para ejecutar el proyecto en un servidor nginx en linux Ubuntu, hay que seguir las siguientes instrucciones:
###1. Instalar los componentes de Backend
Necesitaremos correr las actualizaciones en nuestro sistemas operativo; ademas instalar nginx y sus respectivas librerias en PHP5

sudo apt-get update
sudo apt-get install nginx php5-fpm php5-cli php5-mcrypt git


###2. Modificar la configuración de PHP
Lo primera cosa que necesitamos es abrir el archivo de configuracion principal de PHP
para el procesador PHP-fpm que utiliza nginx. Abra el archivo con permisos de adiministrador en un editor de texto

sudo nano /etc/php5/fpm/php.ini

Una vez abierto el archivo modifique la linea con el parametro cgi.fix_pathinfo (posiblemente esta comentada o con un valor de 1) y la cambias a cero

cgi.fix_pathinfo=0

Esto le indica a PHP que no intente ejecutar scripts con nombres similares si el archivo que buscar no es encontrado.
Una vez finalizado, guardar y cerrar el archivo.

La ultima pieza de la administracion de PHP a modificar es activar la extension mCrypt
de la cual Laravel depende.

sudo php5enmod mcrypt

Ahora reiniciamos el servicio php5-fpm para que se implementen los cambios realizados

sudo service php5-fpm restart

###3. Configurar Nginx y la ruta web

Crearemos un directorio para alojar nuestro proyecto, para eso necesitamos hacerlo con permisos de administrador, en este caso sera:

sudo mkdir -p /var/www/mooc_ucc

Ahora que tenemos una ubicacion para los componentes de laravel, podemos move y editar un servidor nginx, para eso abrimos el archivo de configuracion por defecto con permisos de administrador:

sudo nano /etc/nginx/sites-available/default

Dentro del archivo agregamos nuestra configuración de servidor


server {
	listen 80;
	listen [::]:80 default_server ipv6only=on;

	root /var/www/mooc_ucc/public;
	index index.php index.html index.htm;	

	server_name 127.0.0.1;
	ssl_certificate /etc/nginx/ssl/nginx.crt;
	ssl_certificate_key /etc/nginx/ssl/nginx.key;
	
	location / {
		try_files $uri $uri/ /index.php?$query_string;
	}

	location ~ \.php$ {
		try_files $uri /index.php =404;
		fastcgi_split_path_info ^(.+\.php)(/.+)$;
		fastcgi_pass unix:/var/run/php5-fpm.sock;
		fastcgi_index index.php;
		fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
		include fastcgi_params;
	}

}


Guardar y cerrar el archivo cuando hallas finalizado, despues para que el servidor nginx lea los cambios, lo reiniciamos ejecutando la siguiente linea:

sudo service nginx restart

#4. Instalar Composer y Laravel

Necesitamos descargar primero Composer para poder utilizar Laravel, para eso ejecutamos la siguientes lineas en consola para instalar Composer:

cd ~
curl -sS https://getcomposer.org/installer | php

Esto nos instalara composer, sin embargo solo lo hara en el directorio escogido, para que quede globalmente en nuestro sistema, utilizamos:

sudo mv composer.phar /usr/local/bin/composer

Ahora que tenemos Composer instalado, vamos a instalar Laravel
Recordemos que nuestro directorio de proyecto (aun vacio) esta en /var/www/mooc_ucc, para instalar su version 4.2 digitamos:

sudo composer create-project laravel/laravel /var/www/mooc_ucc 4.2

Ahora nuestros archivos quedan en el directorio /var/www/mooc_ucc pero quedan con cuenta de administrador, por lo cual vamos a cambiarlos a otro:

sudo chown -R :www-data /var/www/mooc_ucc

Nuestro siguiente paso es cambiar los permisos de /var/www/mooc_ucc/app/storage que necesitan ser cambiados para que la aplicación funcione

sudo chmod -R 775 /var/www/mooc_ucc/app/storage

Una vez hecho esto podremos ingresar a localhost y nos deberia permitir ver nuestra pagina de index



