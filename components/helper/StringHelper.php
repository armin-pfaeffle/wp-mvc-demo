<?php

namespace MvcDemo\components\helper;


class StringHelper
{
	/**
	 * Checks if string $haystack start withs $needle. Via $caseSensitive you can control whether comparison is case sensitive or case insensitive.
	 *
	 * @param string $haystack
	 * @param string $needle
	 * @param bool $caseSensitive
	 * @return bool
	 */
	public static function startsWith($haystack, $needle, $caseSensitive = true)
	{
		$compareFunction = ($caseSensitive ? 'strncmp' : 'strncasecmp');
		return !$compareFunction($haystack, $needle, strlen($needle));
	}

	/**
	 * Checks if string $haystack starts with $needle. Via $caseSensitive you can control wheter comparison is case sensitive or case insensitive.
	 *
	 * @param string $haystack
	 * @param string $needle
	 * @param bool $caseSensitive
	 * @return bool
	 */
	public static function endsWith($haystack, $needle, $caseSensitive = true)
	{
	    $length = strlen($needle);
	    if ($length == 0) {
	        return true;
	    }

	    if (!$caseSensitive) {
			$haystack = strtolower($haystack);
			$needle = strtolower($needle);
	    }

	    return (substr($haystack, -$length) === $needle);
	}
}
