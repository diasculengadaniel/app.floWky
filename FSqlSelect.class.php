<?php
/*
 * Manipulate SELECT instructions.
* */
final class FSqlSelect extends FSqlInstruction{
 private $columns;

 public function addColumn($column){
  $this->columns[] = $column;
 }

 public function getInstruction(){
  $this->sql = 'SELECT';
  $this->sql .= implode(',', $this->columns);
  $this->sql .= ' FROM ' .$this->entity;

  if($this->criteria){
   $expression = $this->criteria->dump();
   if($expression){
    $this->sql .= ' WHERE ' . $expression;
   }
   $order = $this->criteria->getProperty('order');
   $limit = $this->criteria->getProperty('limit');
   $offset= $this->criteria->getProperty('offset');

   // Get SELECT  ordination
   if($order){
    $this->sql .= ' ORDER BY ' . $order;
   }
   if($limit){
    $this->sql .= ' LIMIT ' . $limit;
   }
   if($offset){
    $this->sql .= ' OFFSET ' . $offset;
   }
  }
  return $this->sql;
 }
}
?>
