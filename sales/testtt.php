<?php

$multi = new MultipleIterator();
$multi->attachIterator(new ArrayIterator($array1));
$multi->attachIterator(new ArrayIterator($array2));

foreach ($multi as $value) {
    list($key1, $key2) = $multi->key();
    list($value1, $value2) = $value;
}
