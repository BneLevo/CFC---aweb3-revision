<?php
    
require CONFIG_PATH . 'databaseInfo.php';

 class Database {
 
  private static $db = null;

  private static $option = [
  
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      
  ];
  
  public static function connexion(){
  
            if (is_null(self::$db) || !self::$db){
            
                try{
                    self::$db = new PDO ("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT . ";charset=utf8mb4", DB_USER, DB_PASSWORD, self::$option);
                }
                catch(PDOException $e)
	              {
                    trigger_error( "Erreur connexion :" . $e->getMessage() . "");
                }
                
            }
            
            return self::$db;
    }
}