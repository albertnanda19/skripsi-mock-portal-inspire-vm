<?php

namespace App\Helpers;

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;

class JWT
{   
    public static function generateTokens(array $claims): array
    {
        $config = Configuration::forAsymmetricSigner(
            new Sha256(),
            InMemory::file(ROOTPATH . 'private.key'), 
            InMemory::file(ROOTPATH . 'public.key')
        );

        $now = new \DateTimeImmutable();
        $access_token = $config->builder()
            ->issuedBy('https://unsrat.ac.id')
            ->permittedFor('https://unsrat.ac.id') 
            ->issuedAt($now)
            ->canOnlyBeUsedAfter($now)
            ->expiresAt($now->modify('+30 minutes'))
            ->withClaim('uid', $claims['uid'])
            ->getToken($config->signer(), $config->signingKey());

        $refresh_token = $config->builder()
            ->issuedBy('https://unsrat.ac.id')
            ->permittedFor('https://unsrat.ac.id')
            ->issuedAt($now)
            ->expiresAt($now->modify('+7 days'))
            ->withClaim('uid', $claims['uid'])
            ->getToken($config->signer(), $config->signingKey());

        return [
            'access_token' => $access_token->toString(),
            'refresh_token' => $refresh_token->toString()
        ];
    }
}