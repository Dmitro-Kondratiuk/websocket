<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Url;
use Spatie\LaravelData\Data;

class PostCreateData extends Data
{
    #[Required,StringType]
    public string $title;

    #[Required,StringType]
    public string $content;
    #[Required,Url]
    public string $image_url;
}
