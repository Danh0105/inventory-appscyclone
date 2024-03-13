<?php

namespace App\Handle;

use Firebase\JWT\JWT;
use DateTimeImmutable;

class AuthHandler
{


    public function GenerateToken($user)
    {
        $secretKey  = env('APP_KEY');
        $tokenId    = base64_encode(random_bytes(16));
        $issuedAt   = new DateTimeImmutable();
        $expire     = $issuedAt->modify('+6 minutes')->getTimestamp();
        $serverName = "your.pbn.name";
        $userID   = $user->id;

        $data = [
            'iat'  => $issuedAt->getTimestamp(),
            'jti'  => $tokenId,
            'iss'  => $serverName,
            'nbf'  => $issuedAt->getTimestamp(),
            'exp'  => $expire,
            'data' => [
                'userID' => $userID,
            ]
        ];

        $token = JWT::encode(
            $data,
            $secretKey,
            'HS256'
        );
        return $token;
    }
}
