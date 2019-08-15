<?php 
// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
/**
 * Conecta com o MySQL usando PDO
 */
function db_connect(){
    $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $PDO;
}

function sanitizeString($string) {
  // matriz de entrada
  $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ô','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );
  // matriz de saída
  $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','O','U','n','n','c','C','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_','_' );
  // devolver a string
  return str_replace($what, $by, $string);
}
