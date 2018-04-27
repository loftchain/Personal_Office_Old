<?php

if (!function_exists('obfuscate_email')) {

	function obfuscate_email($email)
	{
		$before = strstr($email, '@', true);  // extract entire substring before @
		$len = strlen($before);
		$starred = substr($before, 0, 2) . str_repeat("*", 4) . substr($before, $len-2, $len) . strstr($email, '@');
		return $starred;
	}
}