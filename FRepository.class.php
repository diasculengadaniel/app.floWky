<?php
/*
 * Provem methods to manage collections of objects
* */
final class FRepository{
 private $class;

 function __construct($class){
  $this->class = $class;
 }

 function load(FCriteria $criteria){
  $sql = new FSqlSelect;
  $sql->addColumn('*');
  $sql->setEntity($this->class);
  $sql->setCriteria($criteria);

  if($conn=FTransaction::get()){
   FTransaction::log($sql->getInstruction());

   if($result){
    while($row = $result->fetchObject($this->class.'Record')){
     $results[]=$row;
    }
   }
   return $results;
  }else{
   throw new Exception('Do not have active transaction');
  }
 }

 function delete(FCriteria $criteria){
  $sql = new FSqlDelete;
  $sql->setEntity($this->class);  
  $sql->setCriteria($criteria);

  if($conn = FTransaction::get()){
   FTransaction::log($sql->getInstruction());
   $result = $conn->exec($sql->getInstruction());
   return $result;
  }else{
   throw new Exception('Do not have active transaction');
  }
 }

 function count(FCriteria $criteria){
  $sql = new FSqlSelect;
  $sql->addColumn('count(*)');
  $sql->setEntity($this->class);
  $sql->setCriteria($criteria);

  if($conn = FTransaction::get()){
   FTRansaction::log($sql->getInstruction());
   $result= $conn->Query($sql->getInstruction());

   if($result){
    $row = $result->fetch();
   }
   return $row[0];
  }else{
   throw new Exception('Do not have active transaction');
  }
 }
}
?>
