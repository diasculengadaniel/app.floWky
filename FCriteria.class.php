<?php
/*
 * Proven interface for criteria definition.
* */
class FCriteria extends FExpression{
 private $expressions;
 private $operators;
 private $properties;

 public function add(FExpression $expression, $operator = self::AND_OPERATOR){
  // In first time is not necessary logic operator to concat.
  if(empty($this->expressions)){
   unset($operator);
  }
  $this->expressions[] = $expression;
  $this->operators[] = $operator;
 }

 public function dump(){
  if(is_array($this->expressions)){
   foreach($this->expressions as $i=> $expression){
    $operator = $this->operators[$i];
    $result = $operator. $expression->dump() . ' ';
   }
   $result = trim($result);
   return "({$result})";
  }
 }

 public function setProperty($property,$value){
  $this->properties[$property] = $value;
 }

 public function getProperty($property){
  return $this->properties[$property];
 }
}
?>
