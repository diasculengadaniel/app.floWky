<?php
/*
 * Implement LOG in TXT
* */
class FLoggerTXT extends FLogger{
 public function write($message){
  $time = date("Y-m-d H:i:s");
  $text = "$time :: $message\n";
  $handler = fopen($this->filename, 'a');
  fwrite($handler, $text);
  fclose($handler);
 }
}
?>
