<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class CreateChatData extends Data
{
    #[Required,Exists('users','id')]
    public int $user_id;
}
