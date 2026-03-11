<?php

function f1($a = 1 + 2, $b = true ? 1 : 2) {var_dump_($a); var_dump_($b);}

function f2($c = ['a' => 1 + 2, 'b' => true ? 5 : 6]) {var_dump_($c);}
function f3($c = array('a' => 1 + 2, 'b' => true ? 5 : 6)) {var_dump_($c);}

function f4($c = [f1()]) {} // invalid PHP
function f5($c = array(f1())) {} // invalid PHP

f1();
f2();
f3();
