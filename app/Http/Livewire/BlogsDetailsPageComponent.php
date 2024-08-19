<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;


// class BlogsDetailsPageComponent extends Component
// {
//     public $content;
//     public $title;
//     public $blogId;
//     public $img;


//     public function mount()
//     {
//         $this->blogId = request()->input('id');
//     }

//     public function render()
//     {
//         $blogPost = $this->fetchBlogPostContent();
//         $this->content = $blogPost['content'];
//         $this->title = $blogPost['title'];
//         $this->img = $blogPost['img'];

//         return view('livewire.blog-details-component')->layout('frontend');
//     }

//     private function fetchBlogPostContent()
//     {
//         $response = Http::get("https://roomista.com/blogs/wp-json/wp/v2/posts/{$this->blogId}");
//         $mediaResponse = Http::get("https://roomista.com/blogs/wp-json/wp/v2/media/{$this->blogId}");
//         Log::info($mediaResponse);
//         if ($response->successful() && $mediaResponse->successful()) {
//             $content = $response->json()['content']['rendered'];
//             $title = $response->json()['title']['rendered'];
//             $img = $mediaResponse->json()['img']['rendered'];
            
//             return ['content' => $content, 'title' => $title,'img' => $img,] ?? '';
//         }
//         return ['content' => '', 'title' => '','img' => ''];
//     }
// }
class BlogsDetailsPageComponent extends Component
{
    public $content;
    public $title;
    public $blogId;
    public $img;
    public $prevPost;
    public $nextPost;

    public function mount()
    {
        $this->blogId = request()->input('id');
    }

    public function render()
    {
        $blogPost = $this->fetchBlogPostContent();
        $this->content = $blogPost['content'];
        $this->title = $blogPost['title'];
        $this->img = $blogPost['img'];

        $this->fetchPreviousAndNextPosts();

        return view('livewire.blog-details-component')->layout('frontend');
    }

    private function fetchBlogPostContent()
    {
        $blog = Blog::where('id' ,$this->blogId)->with('media')->first();
        // dd($blog);
        if ($blog) {
            $description = $blog->description;
            $title = $blog->title;
            $image = $blog->media[0]->original_url;
           

            return ['content' => $description, 'title' => $title, 'img' => $image];
        }

        return ['content' => '', 'title' => '', 'img' => ''];
    }

    private function fetchPostDetails($postId)
    {
        if ($postId) {
            $blog = Blog::find($postId);

            if ($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'img' => $blog->image,
                ];
            }
        }

        return null;
    }

    private function fetchPreviousAndNextPosts()
    {
        $blogs = Blog::all();

        $currentIndex = $blogs->search(function ($blog) {
            return $blog->id == $this->blogId;
        });

        $prevPostId = ($currentIndex > 0) ? $blogs[$currentIndex - 1]->id : null;
        $nextPostId = ($currentIndex < $blogs->count() - 1) ? $blogs[$currentIndex + 1]->id : null;

        $this->prevPost = $this->fetchPostDetails($prevPostId);
        $this->nextPost = $this->fetchPostDetails($nextPostId);
    }
   
}
// class BlogsDetailsPageComponent extends Component
// {
//     public $content;
//     public $title;
//     public $blogId;
//     public $img;

//     public function mount()
//     {
//         $this->blogId = request()->input('id');
//     }

//     public function render()
//     {
//         $blogPost = $this->fetchBlogPostContent();
//         $this->content = $blogPost['content'];
//         $this->title = $blogPost['title'];
//         $this->img = $blogPost['img'];

//         return view('livewire.blog-details-component')->layout('frontend');
//     }

//     private function fetchBlogPostContent()
// {
//     $response = Http::get("https://roomista.com/blogs/wp-json/wp/v2/posts/{$this->blogId}");

//     if ($response->successful()) {
//         $blogData = $response->json();

//         // Check if $blogData is an array and not empty
//         if (is_array($blogData) && !empty($blogData)) {
//             // Get the first item in the array
//             $firstPost = reset($blogData);

//             // Check if $firstPost is an array
//             if (is_array($firstPost)) {
//                 $content = $firstPost['content']['rendered'] ?? '';
//                 $title = $firstPost['title']['rendered'] ?? '';
                
//                 // Assuming featured media ID is retrieved from the post
//                 $featuredMediaId = $firstPost['featured_media'];
                
//                 // Fetch the featured media data separately
//                 $mediaResponse = Http::get("https://roomista.com/blogs/wp-json/wp/v2/media/{$featuredMediaId}");
                
//                 if ($mediaResponse->successful()) {
//                     $img = $mediaResponse->json()['guid']['rendered'] ?? '';
//                 } else {
//                     $img = '';
//                 }

//                 return ['content' => $content, 'title' => $title, 'img' => $img];
//             }
//         }
//     }

//     return ['content' => '', 'title' => '', 'img' => ''];
// }

// }


?>