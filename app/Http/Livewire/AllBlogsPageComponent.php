<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Http;
use App\Models\Blog;

// class AllBlogsPageComponent extends Component
// {
    
//     public function render()
//     {
        
//         return view('livewire.all-blogs-page-component')->layout('frontend');
//     }
    

// }
// class AllBlogsPageComponent extends Component
// {
//     public $blogs;

//     public function mount()
//     {
        // Fetch blog data from the API
        // $response = Http::get("https://roomista.com/blogs/wp-json/wp/v2/posts");

//         if ($response->successful()) {
//             $this->blogs = $response->json();
//         }
//     }

//     public function render()
//     {
//         return view('livewire.all-blogs-page-component')->layout('frontend');
//     }
// }



// class AllBlogsPageComponent extends Component
// {
//     public $blogs;

//     public function mount()
//     {
        
//         $response = Http::get("https://roomista.com/blogs/wp-json/wp/v2/posts");

//         if ($response->successful()) {
//             $blogs = $response->json();

//             foreach ($blogs as &$blog) {
//                 $featuredMediaId = $blog['featured_media'];
//                 $mediaResponse = Http::get("https://roomista.com/blogs/wp-json/wp/v2/media/{$featuredMediaId}");

//                 if ($mediaResponse->successful()) {
//                     $blog['img'] = $mediaResponse->json()['guid']['rendered'];
//                 } else {
//                     $blog['img'] = ''; 
//                 }
//             }

//             $this->blogs = $blogs; 
//         }
//     }

//     public function render()
//     {
//         return view('livewire.all-blogs-page-component')->layout('frontend');
//     }
// }

class AllBlogsPageComponent extends Component
{
    public $blogs;
    public $allBlogs;

    public function mount()
    {
       
    }

    public function render()
    {
        $allBlogs =Blog::where('status', 'active')->with('media')->get();
        $this->blogs = $allBlogs;
        // dd($allBlogs);
        return view('livewire.all-blogs-page-component')->layout('frontend');
    }
}