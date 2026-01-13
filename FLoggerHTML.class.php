<?php
/*
 * Implement LOG In HTML
* */
class FLoggerHTML extends FLogger{
 public function write($message){
  $time = date("Y-m-d H:i:s");
  $text = "<p>\n";
  $text. = " <b>$time</b>: \n";
  $text. = " <i>$message</i> <br>\n";
  $text. = "</p>\n";

  $handler = fopen($this->filename, 'a');
  fwrite($handler, $text);
  fclose($handler);
 }
}
?>
