<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PostsData extends Data
{
    public function __construct(
        public ?int              $id,
        public ?string           $title,
        public ?string           $content,
        public ?string           $image_url,
        public int|Optional      $likes,
        #[MapInputName('morphable')]
        public UserData|Optional $user
    )
    {
    }
}
