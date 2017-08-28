<?php
 //@author JunioSantos

class BD {
    private static $conn;    
    public function __construct(){}
    
    public static function conn(){
        if (is_null(self::$conn)) {
            self::$conn = new PDO('mysql:host=localhost;dbname=sitepro2;','root','');
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
    }
    return self::$conn;
    }
}

function logErrors($errno){
    if(error_reporting() == 0) return;
    $exec = func_get_arg(0);
    $errno = $exec->getCode();
    $errstr = $exec->getMessage();
    $errfile = $exec->getFile();
    $errline = $exec->getLine();
    $err ='CAUGHT EXCEPTION';
    if(ini_get('log_errors')){
    error_log(sprintf("PHP %s: %s in %s on line % d, $err, $errstr, $errfile, $errline"));
    }
    $strErro = 'erro: '.$err.' no arquivo: '.$errfile.' (line '.$errline .') :: IP: ('.$_SERVER['REMOTE_ADDR'].')';
    $strErro .= 'data: '.date('d/m/Y')."\n\n";
    $arquivo = fopen("errlog.txt",'a');
    fwrite($arquivo, $strErro);
    fclose($arquivo);
    
    set_error_handler('logErrors');
}

