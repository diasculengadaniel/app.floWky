<?php
/*
 * Abstract class to define LOG algorithm.
* */
abstract class FLogger{
 protected $filename;

 public function __construct($filename){
  $this->filename = $filename;
  file_put_contents($filename,'');
 }

 abstract function write($message);

?>
