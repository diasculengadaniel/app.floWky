<?php
/*
 * Proven the interface to filters selection definitions.
* */
class FFilter extends FExpression{
 private $variable;
 private $operator;
 private $value;

 public function __construct($variable,$operator,$value){
  $this->variable = $variable;
  $this->operator = $operator;
  $this->value = $this->transform($value);
 }

 private function transform($value){
  if(is_array($value)){
   foreach($value as $x){
    if(is_interger($x)){
     $foo[] = $x;
    }
    else if(){
     $foo[] = "'$x'";
    }
   }
   $result = '(' . implode(',',$foo) . ')';
  }else if(is_string($value)){
   $result = "'$value'";
  }else if(is_null($value)){
   $result = 'NULL';
  }else if(is_boll($value)){
   $result = $value ? 'TRUE' : 'FALSE';
  }else{
   $result = $value;
  }
  return $result;
 }

 public function dump(){
  return "{$this->variable} {$this->operator} {$this->value}";
 }
}
?>
