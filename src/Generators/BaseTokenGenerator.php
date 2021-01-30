<?php

namespace Nanuc\LaravelTokenable\Generators;

use Nanuc\LaravelTokenable\Models\Token;

abstract class BaseTokenGenerator
{
    abstract protected function generate();

    public function generateToken()
    {
        $utilizedTokens = Token::where('expires_at', '>', now())->pluck('token');

        do {
            $token = $this->generate();
        } while($utilizedTokens->contains($token));

        return $token;
    }
}