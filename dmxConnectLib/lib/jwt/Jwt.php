<?php

namespace lib\jwt;

class Jwt
{
    public static $algos = array(
        'HS256' => 'sha256',
        'HS384' => 'sha384',
        'HS512' => 'sha512',
        'RS256' => OPENSSL_ALGO_SHA256,
        'RS384' => OPENSSL_ALGO_SHA384,
        'RS512' => OPENSSL_ALGO_SHA512
    );

    private function __construct() {}

    public static function sign($options) {
        $options = (array)$options;
        $header = $options['header'];
        $payload = $options['payload'];
        $key = $options['key'];
        $algo = $header['alg'];

        $header = self::encode($header);
        $payload = self::encode($payload);
        $signature = self::encode(self::signature($header . '.' . $payload, $algo, $key));

        return $header . '.' . $payload . '.' . $signature;
    }

    public static function decode($options) {
        $options = (array)$options;
        $token = $options['token'];

        $parts = explode('.', $token);

        $header = self::base64url_decode($parts[0]);
        $payload = self::base64url_decode($parts[1]);
        $signature = $parts[2];

        return (object)array(
            'header' => json_decode($header),
            'payload' => json_decode($payload),
            'signature' => $signature
        );
    }

    public static function verify($options) {
        $options = (array)$options;
        $token = $options['token'];
        $key = $options['key'];

        $decoded = self::decode($options);
        $header = (array)$decoded->header;
        $payload = (array)$decoded->payload;
        $signature = self::base64url_decode($decoded->signature);
        $data = self::encode($header) . '.' . self::encode($payload);
        $algo = $header['alg'];

        // check expired
        if (isset($decoded->payload->exp) && $decoded->payload->exp < time()) {
            throw new \Exception("JWT is expired");
        }

        if (substr($algo, 0, 2) === 'HS') {
            $verify = hash_equals(hash_hmac(self::$algos[$algo], $data, $key, true), $signature);
        } else {
            $verify = openssl_verify($data, $signature, openssl_pkey_get_public($key), self::$algos[$algo]);
        }

        if (!$verify) {
            throw new \Exception("Invalid signature");
        }

        return $decoded->payload;
    }

    private static function signature($data, $algo, $key) {
        if (substr($algo, 0, 2) === 'HS') {
            return hash_hmac(self::$algos[$algo], $data, $key, true);
        }

        openssl_sign($data, $signature, openssl_pkey_get_private($key), self::$algos[$algo]);

        return $signature;
    }

    private static function encode($data) {
        if (\is_array($data)) {
            $data = json_encode($data, JSON_UNESCAPED_SLASHES);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("JSON failed: " . json_last_error_msg());
            }
        }

        return self::base64url_encode($data);
    }

    private static function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64url_decode($data) {
        return base64_decode(strtr($data, '-_', '+/'));
    }
}