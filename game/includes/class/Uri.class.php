<?php

class Uri {
  static $base;
  static $current;

  static function init() {
    Uri::$base    = static::get_base_url();
    Uri::$current = static::$base . $_SERVER['REQUEST_URI'];
  }

  static function base() {
    return Uri::$base . '/';
  }

  static function create($to) {
    return Uri::base() . $to;
  }

  static function current() {
    return Uri::$current;
  }

  public static function get_base_url() {
    $base_url = '';
    if ($_SERVER['HTTP_HOST']) {
      $base_url .= 'http://' . $_SERVER['HTTP_HOST'];
    }
    if ($_SERVER['SCRIPT_NAME']) {
      $common = static::get_common_path(array(
        $_SERVER['REQUEST_URI'],
        $_SERVER['SCRIPT_NAME']
      ));
      $base_url .= $common;
    }

    // Add a slash if it is missing and return it
    return rtrim($base_url, '/') . '/';
  }

  static function get_common_path($paths) {
    $lastOffset = 1;
    $common     = '/';
    while (($index = strpos($paths[0], '/', $lastOffset)) !== false) {
      $dirLen = $index - $lastOffset + 1; // include /
      $dir    = substr($paths[0], $lastOffset, $dirLen);
      foreach ($paths as $path) {
        if (substr($path, $lastOffset, $dirLen) != $dir) {
          return $common;
        }
      }
      $common .= $dir;
      $lastOffset = $index + 1;
    }
    return $common;
  }
}
