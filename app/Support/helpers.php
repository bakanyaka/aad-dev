<?php

/**
 * Round a Windows timestamp down to seconds and remove
 * the seconds between 1601-01-01 and 1970-01-01.
 *
 * @param float $windowsTime
 *
 * @return float
 */
function convertWindowsTimeToUnixTime($windowsTime)
{
    return round($windowsTime / 10000000) - 11644473600;
}

/**
 * Convert a Unix timestamp to Windows timestamp.
 *
 * @param float $unixTime
 *
 * @return float
 */
function convertUnixTimeToWindowsTime($unixTime)
{
    return ($unixTime + 11644473600) * 10000000;
}