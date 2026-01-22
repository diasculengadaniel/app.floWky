<?php
/*
 * Prove methods to presist and load objects from data base(Active Record)
* */
abstract class FRecord{
 protected $data;

 public function __construct($id=NULL){
  if($id){
   $object = $this->load($id);
   if($object){
    $this->fromArray($object->toArray());
   }
  }
 }

 // Clean Id to generate a new ID for the clone.
 public function __clone(){
  unset($this->id);
 }

 private function __set($prop, $value){
  if(method_exists($this, 'set_' .$prop)){
   call_user_func(array($this, 'set_' .$prop),$value);
  }else{
   $this->data[$prop]=$value;
  }
 }

 private function __get(){
  if(method_exists($this,'get_' .$prop)){
   return call_user_func(array($this, 'get_'.$prop));
  }else{
   return $this->data[$prop];
  }
 }

 private function getEntity(){
  $class = strtolower(get_class($this));
  return substr($class, 0,-6);
 }
 
 public function fromArray($data){
  $this->data=$data;
 }

 public function toArray(){
  return $this->data;
 }

 public function store(){
  if(empty($this->data['id'])or (!$this->load($this->id))){
   $this->id = $this->getLast()+1;
   $sql = new FSqlInsert;
   $sql->setEntity($this->getEntity());
   foreach($this->data as $key=>$value){
    $sql->setRowData($key,$this->$key);
   }
  }else{
   $sql = new FSqlUpdate;
   $sql->setEntity($this->getEntity());
   $criteria = new FCriteria;
   $criteria->add(new FFilter('id', '=', $this->id));
   $sql->setCriteria($criteria);
   foreach($this->data as $key=>$value){
    if($key !== 'id'){
     $sql->setRowData($key,$this->$key);
    }
   }
  }
  if($conn = FTransaction::get()){
   FTransaction::log($sql->getInstruction());
   $result = $conn->exec($sql->getInstruction());
   return $result;
  }else{
   throw new Exception('Do not have active transaction');
  }
 }

 public function load($id){
  $sql = new FSqlSelect;
  $sql->setEntity($this->getEntity());
  $sql->addColumn('*');

  $criteria = new FCriteria;
  $criteria->add(new FFilter('id','=',$id));
  $sql->setCriteria($criteria);
  if($conn = FTransaction::get()){
   FTransaction::log($sql->getInstruction());
   $result = $conn->Query($sql->getInstruction());
   if($result){
    $object = $result->fetchObject(get_class($this));
   }
   return $object;
  }else{
   throw new Exception('Do not have active transaction');
  }
 }

 public function delete($id){
  $id = $id ? $id : $this->id;
  $sql = new FSqlDelete;
  $sql->setEntity($this->getEntity());

  $criteria = new FCriteria;
  $criteria->add(new FFilter('id','=',$id));
  $sql->setCriteria($criteria);

  if($conn = FTransaction::get()){
   FTransaction::log($sql->getInstruction());
   $result = $conn->exec($sql->getInstruction());
   return $result;
  }else{
   throw new Exception('Do not have active transaction');
  }
 }
}
?>
