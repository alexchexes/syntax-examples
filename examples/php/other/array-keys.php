<?php

$a = [
    "key"       => 'value',
    'key'       => 'value',
    2           => 'value',
    my_fn()     => 'value',
    my_fn($a)   => 'value',
];

function FunctionName($a) { 
    foreach ($a as $key => $value) {
        yield "key" => 'value';
        yield 'key' => 'value';
        yield 2     => 'value';
        yield 3     => 456;
        yield $key  => $value;
    }
}

fn() => null;
fn($a) => null;

function my_fn () {}

function t1($a = array('123' => 1)) {}

function t2($a = array(my_fn() => 1)) {}
