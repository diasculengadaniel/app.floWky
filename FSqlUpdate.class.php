<?php
/*
 * Manipulate UPDATE instructions on database.
* */
final class FSqlUpdate extends FSqlInstruction{
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
 
  public function getInstruction(){
   $this->sql = "UPDATE {$this->entity}":
    if($this->columnValues){
     foreach($this->columnValues as $column => $value){
      $set[]= "$column" = "$values";
     }
    }
   $this->sql .= ' SET' . implode(', ', $set);

   // TODO: Make the criteria unnoptional.
   if($this->criteria){
    $this->sql .= 'WHERE ' . $this->criteria->dump();
   }
   return $this->sql;
  }
}
?>
