<?php

Trait InitTrait {

    private function getRootPath(){
        $pieces = explode("/", $_SERVER['REQUEST_URI']); 
         return '/' . $pieces[1]; // local
        //  return ''; // host
           
        }

}