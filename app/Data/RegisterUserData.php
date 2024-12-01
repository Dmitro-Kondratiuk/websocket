<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class RegisterUserData extends Data
{
    #[Required, Email,Unique('users', 'email')]
    public string $email;

    #[Required,StringType]
    public string $name;

    #[Required, Password(min: 8, mixedCase: true, numbers: true)]
    public string $password;
}
