<?php


namespace App\Actions\Encryption;


use Defuse\Crypto\Crypto;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;

class Encryption
{
    /**
     * @param string $data
     * @return string
     */
    public static function salt(string $data): string
    {
        $separator = config('encryption.separator');
        $salt = config('encryption.salt');

        return sprintf(
            '%s%s%s%s%s',
            $salt, $separator, $data, $separator, $salt,
        );
    }

    /**
     * @param string $salted
     * @return string
     */
    public static function reverse_salt(string $salted): string
    {
        $separator = config('encryption.separator');
        $salt = config('encryption.salt');

        return explode($separator, $salted)[1];
    }

    /**
     * @param string $data
     * @return string
     * @throws EnvironmentIsBrokenException
     */
    public static function encrypt(string $data): string
    {
        return Crypto::encrypt(static::salt($data), Key::get());
    }

    /**
     * @param string $data
     * @param string|null $key
     * @return string
     * @throws EnvironmentIsBrokenException
     * @throws WrongKeyOrModifiedCiphertextException
     */
    public static function decrypt(string $data, string|null $key = null): string
    {
        if ($key === null) {
            $key = Key::get();
        }

        return static::reverse_salt(Crypto::decrypt($data, $key));
    }
}
