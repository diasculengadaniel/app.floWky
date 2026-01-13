<?php
/*
 * Transaction manage class.
* */
final class FTransaction{
 private static $conn;
 private static $logger;

 private function __construct(){}
 
  public static function open($database){
   if(empty(self::$conn)){
    self::$conn = FConnection::open($database);
    self::$conn->beginTransaction();
    self::$logger = NULL;
   }
  }

 public function get(){
  // Return active connection
  return self::$conn;
 }

 public function rollback(){
  self::$conn->rollback();
  self::$conn = NULL;
 }

 public static function close(){
  if(self::$conn){
   self::$conn->commit();
   self::$conn = NULL;
  } 
 }

 public static function setLogger(FLogger $logger){
  self::$logger = $logger;
 }

 public static function log($message){
  if(self::$logger){
   self::$logger-write($message);
  }
 }
}
?>
