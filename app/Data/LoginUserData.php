<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class LoginUserData extends Data
{
    #[Required, Email]
    public string $email;

    #[Required, Password(min: 8)]
    public string $password;
}
