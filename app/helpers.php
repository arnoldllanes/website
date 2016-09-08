<?php

class Menu {

 public static function activeMenu($uri='')
 {
  $active = '';

  if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri) || Request::is($uri . '/' . Request::segment(2)))
  {
   $active = 'active';
  }

  return $active;
 }

}