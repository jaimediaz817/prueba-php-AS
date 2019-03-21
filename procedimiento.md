# Composer:    
    - Manejador de dependencias
    - Por defecto se instala en c:/composer/*, por si no funciona el comando hay que 
    importar composer.phar en la raíz del proyecto:

    - Crear el fichero: composer.json
    - Abrir la terminal y ejecutar:
    php composer.phar install + ENTER

    - COMANDOS adicionales (importante):
        php composer.phar install
        composer clear cache
        composer dump-autoload    

# DOT ENV
    - instalación del paquete dotenv:
    php composer.phar install

    - para utilizarlo:
            $dotenv = Dotenv::create(__DIR__.'/private');
            $dotenv->load();
            $varEnv = getenv('DB_HOST_DEV')

# Fire PHP
    - Permite depurar código de PHP en la consola del navegador.
    - comando:
    php composer.phar require firephp/firephp-core + ENTER

    - Instalar extensión en Chrome para visualizar logs:
    - URL:
    https://chrome.google.com/webstore/detail/firephp4chrome/gpgbmonepdpnacijbbdijfbecmgoojma
    - Criterio busqueda:  fire php + ENTER

# SLIM FRAMEWORK    
    - Es ligero para agregar funcionalidades, (orm, query builders), hacer una API rest full
    php composer.phar require slim/slim



# PHP MAILER
 php composer.phar require phpmailer/phpmailer

 

