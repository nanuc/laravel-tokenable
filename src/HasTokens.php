<?php

namespace Nanuc\LaravelTokenable;

use Nanuc\LaravelTokenable\Generators\NumericTokenGenerator;
use Nanuc\LaravelTokenable\Models\Token;

trait HasTokens
{
    public function tokens()
    {
        return $this->morphMany(Token::class, 'model');
    }

    public function generateToken($lifetime, $type = null, $tokenGenerator = null)
    {
        if(is_null($tokenGenerator)) {
            $tokenGenerator = new NumericTokenGenerator();
        }

        return $this->tokens()->create([
            'type' => $type,
            'expires_at' => now()->addSeconds($lifetime),
            'token' => $tokenGenerator->generateToken()
        ]);
    }

    public function invalidateTokens($type = null)
    {
        $this->tokens()->where('type', $type)->delete();
    }

    public static function byToken($token, $type = null)
    {
        $token = Token::query()
            ->where('model_type', self::class)
            ->where('token', $token)
            ->where('type', $type)
            ->where('expires_at', '>', now())
            ->first();

        ray($token);
        return optional($token)
            ->tokenable;
    }
}