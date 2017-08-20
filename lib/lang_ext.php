<?php
/**
 * This file introduces extended functions for PHP.
 *
 * @author Angus.Fenying
 */
declare(strict_types = 1);

namespace L;

const REXP_EMAIL = <<<'REGEXP'
/^[-_\w\.]+\@[-_\w]+(\.[-_\w]+)*$/i
REGEXP;

const REXP_HEX = '/^[0-9a-f]+$/i';

const REXP_IPV4 = <<<'REGEXP'
/^[0-9]{1,3}(\.[0-9]{1,3}){3}$/
REGEXP;

const RAND_SEED_N = '0123456789';

const RAND_SEED_U = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

const RAND_SEED_L = 'abcdefghijklmnopqrstuvwxyz';

const RAND_SEED_UN = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

const RAND_SEED_LN = 'abcdefghijklmnopqrstuvwxyz0123456789';

const RAND_SEED_LU = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

const RAND_SEED_LUN = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

function array_part(array $arr, array $keys): array
{
    $rtn = [];
    
    foreach ($keys as $key) {
        
        $rtn[$key] = $arr[$key];
    }
    
    return $rtn;
}

function array_exist_keys(array $arr, array $keys): bool
{
    foreach ($keys as $k) {
        
        if (!array_key_exists($k, $arr)) {
            
            return false;
        }
    }

    return true;
}

function str_rand(int $length, string $source = RAND_SEED_LUN): string
{
    $sourceLength = strlen($source);
    $temp = '';

    for ($i = $length; $i--;) {

        $temp .= $source[rand(0, $sourceLength - 1)];
    }

    return $temp;
}

function byte2hex(int $i): string
{
    $s = '0123456789ABCDEF';
    return $s[($i & 0xF0) >> 4] . $s[$i & 0xF];
}

function str2hex(string $b): string
{
    $l = strlen($b);
    $rtn = '';

    for ($i = 0; $i < $l; ++$i) {

        $rtn .= byte2hex(ord($b[$i]));
    }

    return $rtn;
}

function size2string(int $size, string $spliter = ' '): string
{
    static $units = array(
        'Bytes',
        'KB',
        'MB',
        'GB',
        'TB',
        'PB'
    );
    $i = 0;

    for (; $i < 6 && $size >= 1024.0; ++$i) {

        $size /= 1024.0;
    }

    return round($size, 2) . $spliter . $units[$i];
}

function is_email(string $email): bool
{
    return preg_match(REXP_EMAIL, $email) ? true : false;
}

function is_ipv4(string $ip): bool
{
    return preg_match(REXP_IPV4, $ip) ? true : false;
}

function is_hex(string $s): bool
{
    return preg_match(REXP_HEX, $s) ? true : false;
}

function startsWith(string $src, string $match): bool
{
    return substr($src, 0, strlen($match)) === $match;
}

function endsWith(string $src, string $match): bool
{
    return substr($src, -strlen($match)) === $match;
}
