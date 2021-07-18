<?php


namespace App\Actions\Encryption;


use Defuse\Crypto\Exception\BadFormatException;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Key as BaseKey;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Key
{
    /**
     * @return string
     * @throws EnvironmentIsBrokenException
     */
    public static function generate(): string
    {
        return bin2hex(BaseKey::createNewRandomKey()->saveToAsciiSafeString());
    }

    /**
     * @param string $string
     * @return BaseKey
     * @throws BadFormatException
     * @throws EnvironmentIsBrokenException
     */
    public static function load(string $string): BaseKey
    {
        return BaseKey::loadFromAsciiSafeString(hex2bin($string));
    }

    /**
     * @param string|null $path
     * @return BaseKey
     * @throws EnvironmentIsBrokenException
     */
    public static function get(string|null $path = null): BaseKey
    {
        if ($path === null) {
            $path = storage_path('secret.key');
        }

        if (! (file_exists($path) && is_file($path))) {
            file_put_contents($path, static::generate());
        }

        return Cache::rememberForever(Str::slug('encryption-key-' . $path), function () use ($path) {
            return static::load(file_get_contents($path));
        });
    }
}
