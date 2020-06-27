<?php




namespace App\Observers;

use App\Models\Post;
use App\Services\PostService;


class PostObserver
{

   

    public function creating($post)
    {
        $post->slug = create_unique_slug($post->title,Post::class);
    }


    public function updating($post)
    {
        $post->slug = create_unique_slug($post->title,Post::class);
    }

    public function deleted($post)
    {
        check_file($post->image);
        $post->tags()->detach();
        $post->views()->delete();
    }
}
