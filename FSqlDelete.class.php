<?php
/*
 * Manipulate DELETE instructions from database.
* */
final class FSqlDelete extends FSqlInstruction{
 // TODO: Don't allow delete without where.
 public function getInstruction(){
  $this->sql = "DELETE FROM {$this->entity}";
  if($this->criteria){
   $expression = $this->criteria->dump();
   if($expression){
    $this->sql .= ' WHERE ' . $expression;
   }
  }
  return $this->sql;
 }
}
?>
