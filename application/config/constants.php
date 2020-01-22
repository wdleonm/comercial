<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

date_default_timezone_set('America/Caracas'); 
/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/* Valores para el tipo de accion en la auditoria */

define('DB_ACTION_INSERT', 'INSERT');
define('DB_ACTION_UPDATE', 'UPDATE');
define('DB_ACTION_DELETE', 'DELETE');
define('DB_ACTION_SELECT', 'SELECT');

/* Definir constantes de la rutas para las subcarpetas */

define('MANEJADOR_CONFIG', 'config');
define('MANEJADOR_RUTA_IMAGENES', 'uploads/imagenes/');
define('MANEJADOR_RUTA_GRAFICAS', 'uploads/graficas/'); 
define('MANEJADOR_RUTA_ARTICULOS', 'uploads/articulos/');
define('MANEJADOR_RUTA_VARIOS', 'uploads/varios/');

/* Definir constantes de para los esquemas en las bases de datos */

define('SYSTEM_SCHEME', 'sys_admin');

/* OTROS */

define('NOMBRE_SISTEMA', 'Prototipo');
define('NOMBRE_SISTEMA_CORTO', 'Prototipo');

/* End of file constants.php */
/* Location: ./application/config/constants.php */
