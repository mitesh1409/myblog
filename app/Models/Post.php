<?php

namespace App\Models;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public function __construct(
        public $title,
        public $slug,
        public $excerpt,
        public $published_at,
        public $body
    ) {}

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
            $document = YamlFrontMatter::parseFile(resource_path("posts/$slug.html"));

            $post = new Post(
                $document->title,
                $document->slug,
                $document->excerpt,
                $document->published_at,
                $document->body()
            );
        } catch (FileNotFoundException $ex) {
            throw new ModelNotFoundException('Post not found', Response::HTTP_NOT_FOUND);
        }

        return Cache::rememberForever("post.$slug", fn() => $post);
    }

    /**
     * Get all the files from the resources/posts directory.
     *
     * @return Illuminate\Support\Collection
     */
    public static function all()
    {
        $allPosts = collect(File::files(resource_path('posts')))
            // map to documents
            ->map(fn($postFile) => YamlFrontMatter::parseFile($postFile->getPathname()))
            // map to Post objects
            ->map(fn($document) => new Post(
                    $document->title,
                    $document->slug,
                    $document->excerpt,
                    $document->published_at,
                    $document->body()
                )
            );

        return Cache::rememberForever('posts.all', fn() => $allPosts);
    }
}
