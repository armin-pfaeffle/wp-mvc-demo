<?php

namespace MvcDemo\core;


class Log
{
	const INFO  =			1;
	const ERROR =			2;
	const DEBUG =			3;

	const DEBUG_NONE =		1;
	const DEBUG_FUNCTION =	2;
	const DEBUG_FULL =		3;

	public static $filename = MVC_DEMO_LOG_FILENAME;


	public static function write($text = '', $level = Log::INFO, $debugInfo = Log::DEBUG_FUNCTION)
	{
		// TODO: Check for settings, if given level should be written to file

		$time = date('d-m-Y H:i:s ');
		$logTypeStr = static::getLogTypeString($level);
		if (is_array($text) || is_object($text)) {
			$text = print_r($text, true);
		}
		$debugInfoStr = static::getDebugInfo($debugInfo);

		$lineFormat = static::getLineFormat($level, $debugInfo);
		$line = sprintf($lineFormat, $time, $logTypeStr, $text, $debugInfoStr);
		file_put_contents(static::$filename, $line, FILE_APPEND | FILE_TEXT);
	}

	protected static function getLogTypeString($level)
	{
		$result = '';
		switch ($level) {
			case static::INFO:
				// It's important here that info has 5 chars, so it has the same width like the others
				$result = 'INFO ';
				break;

			case static::ERROR:
				$result = 'ERROR';
				break;

			case static::DEBUG:
				$result = 'DEBUG';
				break;

			default:
				$result = '     ';
		}
		return $result;
	}

	protected static function getDebugInfo($debugInfo)
	{
		$result = null;
		if ($debugInfo == static::DEBUG_FUNCTION || $debugInfo == static::DEBUG_FULL) {
			$debugBacktrace = debug_backtrace(false);
			if ($debugInfo == static::DEBUG_FUNCTION) {
				$result = $debugBacktrace[2]['class'] . '@' . $debugBacktrace[2]['function'];
			} elseif ($debugInfo == static::DEBUG_FULL) {
				$result = print_r($debugBacktrace, true);
			}
		}
		return $result;
	}

	protected static function getLineFormat($level, $debugInfo)
	{
		/*
		%1$s : time
		%2$s : log type as string
		%3$s : text
		%4$s : debugInfo
		*/
		$result = '';
		switch ($debugInfo) {
			case static::DEBUG_NONE:
				$result = '%1$s [%2$s] %3$s';
				break;

			case static::DEBUG_FUNCTION:
				$result = '%1$s [%2$s] %4$s: %3$s';
				break;

			case static::DEBUG_FULL:
				$result = '%1$s [%2$s] %3$s' . "\n" . '%4$s';
				break;
		}
		$result .= "\n";
		return $result;
	}
}