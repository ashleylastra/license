<?php
/*
|--------------------------------------------------------------------------
| US Technologies Inventory Management System V2
|--------------------------------------------------------------------------
| Author: Saeed Nawaz
| Project Name: USTech-IMS
| Version: v2
| Support page: http://ustechlogix.net/
|
|
|
*/

  #define( 'DB_HOST', 'localhost' );          // Set database host
  define( 'DB_HOST', getenv('DB_HOST', true) ?: getenv('DB_HOST') );          // Set database host
  
  #define( 'DB_USER', 'root' );             // Set database user
  define( 'DB_USER', getenv('DB_USER', true) ?: getenv('DB_USER') );             // Set database user
  
  #define( 'DB_PASS', 'Wally13!' );             // Set database password
  define( 'DB_PASS', getenv('DB_PASS', true) ?: getenv('DB_PASS') );             // Set database password
  
  #define( 'DB_NAME', 'inventorymanager' );        // Set database name
  define( 'DB_NAME', getenv('DB_NAME', true) ?: getenv('DB_NAME') );        // Set database name

?>
