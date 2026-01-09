<?php
/*
 * Mmanipulate INSERT instructions o data base
* */
final class FSqlInsert extends FSqlInstruction{
 public function setRowData($column,$value){
  if(is_string($value)){
   // Adiciona \ em aspas
   $value = addslashes($value);
   $this->columnValues[$column] = "'$value'";
  }else if(is_bool($value)){
   $this->columnValues[$column]= $value ? 'TRUE':'FALSE';
  }else if(isset($value)){
   $this->columnValues[$column] = $values;
  }else{
   $this->columnValues[$column] = "NULL";
  }
 }

 public function setCriteria($criteria){
  throw new Exception("Cannot call setCriteria form " . __CLASS__);
 }

 public function getInstruction(){
  $this->sql = "INSERT INTO {$this->entity}";
  $columns = implode(', ', array_keys($this->columnValues));
  $values = implode(', ', array_values($this->columnValues));
  $this->sql .= $columns . ')';
  $this->sql .= " values ({$values})";

  return $this->sql;
 }
}
?>
