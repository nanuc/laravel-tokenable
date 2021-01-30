This package lets you add tokens to models.

## Installation
`composer require nanuc/laravel-tokenable`

## Usage
Add the `HasTokens` trait to your model.

Use the following methods:
```php
$model->generateToken($lifetime, $type = null, $tokenGenerator = null);
$model->invalidateTokens($type);
$model::byToken($token, $type);
```

Lifetime is in seconds.

### Token Generators
You can create your own token generators. They must extend `Nanuc\LaravelTokenable\Generators\BaseTokenGenerator` and implement the method `generate`.

This is the default token generator:
```php
class NumericTokenGenerator extends BaseTokenGenerator
{
    protected $length;

    public function __construct($length = 4)
    {
        $this->length = $length;
    }

    protected function generate()
    {
        $start = 10 ** ($this->length - 1);
        $end = 10 * $start - 1;

        return rand($start, $end);
    }
}
```

Use your token generator like:
```php
$yourModel->generateToken(60, 'a-type', new YourTokenGenerator());
```