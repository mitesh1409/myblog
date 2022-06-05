<?php

namespace App\Models;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Post
{
    /**
     * Get the post by its slug.
     *
     * @param string $slug
     * @return string
     *
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public static function find(string $slug)
    {
        try {
            $fileContents = File::get(resource_path("posts/$slug.html"));
        } catch (FileNotFoundException $ex) {
            throw new ModelNotFoundException('Post not found', Response::HTTP_NOT_FOUND);
        }

        return Cache::rememberForever("post.$slug", fn() => $fileContents);
    }

    public static function all()
    {
        return collect(File::files(resource_path('posts')))
                ->map(fn($postFile) => File::get($postFile->getPathname()));
    }
}
