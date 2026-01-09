<?php
/*
Abstract class to manage expressions
**/
abstract class FExpression{
 const AND_OPERATOR = 'AND ';
 const OR_OPERATOR = 'OR';

 abstract public function dump();
}
?>
