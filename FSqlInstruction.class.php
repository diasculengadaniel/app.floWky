<?php
/*
 * Proven a commom methods for all sql instructions.
* */
abstract class FSqlInstruction{
 protected $sql;
 protected $criteria;
 
 final public function setEntity($entity){
  $this->entity = $entity;
 }

 final public function getEntity(){
  return $this->entity;
 }

 public function setCriteria(FCriteria $criteria){
  $this->criteria = $criteria;
 }

 abstract function getInstruction();
}
?>
