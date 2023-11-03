<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class Blogs extends Component
{
    use WithPagination;

    // protected $paginationTheme = "bootstrap";
    
    public function render()
    {
        return view('livewire.blogs', [
            "blogs" => Blog::latest()->paginate(5)
        ]);
    }
}
