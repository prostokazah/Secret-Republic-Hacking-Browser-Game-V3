<?php

class Uri {
	static $base;
	static $current;

	static function init() {
		Uri::$base = "http://" . $_SERVER['HTTP_HOST'];
		Uri::$current = Uri::$base . $_SERVER['REQUEST_URI'];

		//if (substr(Uri::$current, -1) != '/') Uri::$current .= '/';

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
}
