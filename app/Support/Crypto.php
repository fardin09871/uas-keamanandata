<?php
namespace App\Support;

class Crypto
{
    public static function pub(): string
    {
        return str_replace("\r", '', trim(file_get_contents(storage_path('app/public.pem'))));
    }

    public static function enc(array $d): array
    {
        $k = random_bytes(32); $iv = random_bytes(12);
        $ct = openssl_encrypt(json_encode($d), 'aes-256-gcm', $k, OPENSSL_RAW_DATA, $iv, $tag);
        openssl_public_encrypt($k, $wk, self::pub(), OPENSSL_PKCS1_OAEP_PADDING);
        return ['data' => base64_encode($iv . $tag . $ct), 'wrapped_key' => base64_encode($wk)];
    }

    public static function dec($row, string $priv): ?array
    {
        $pk = openssl_pkey_get_private($priv);
        if (!$pk || !openssl_private_decrypt(base64_decode($row->wrapped_key), $k, $pk, OPENSSL_PKCS1_OAEP_PADDING)) return null;
        $raw = base64_decode($row->data);
        $p = openssl_decrypt(substr($raw, 28), 'aes-256-gcm', $k, OPENSSL_RAW_DATA, substr($raw, 0, 12), substr($raw, 12, 16));
        return $p === false ? null : json_decode($p, true);
    }

    public static function keyMatches(string $priv): bool
    {
        $pk = @openssl_pkey_get_private($priv);
        if (!$pk) return false;
        return trim(str_replace("\r", '', openssl_pkey_get_details($pk)['key'])) === self::pub();
    }
}
