<?php
$pieces = explode("/", $_SERVER['REQUEST_URI']); 
$root_path =  '/' . $pieces[1]; // local
// $root_path =  ''; // host
