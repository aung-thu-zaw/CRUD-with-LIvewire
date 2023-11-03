<?php

namespace App\Livewire;

use App\Models\Blog;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Blogs extends Component
{
    use WithPagination;

    // protected $paginationTheme = "bootstrap";
    public $categories;

    public $searchByKeyword;

    public $searchByCategory;

    public function mount()
    {
        $this->categories = Category::pluck('name', 'id');

        $this->searchByKeyword = '';
        $this->searchByCategory = 0;
    }

    public function render()
    {
        $blogs = Blog::with('category')
            ->when($this->searchByKeyword !== '', function ($query) {
                $query->where('title', 'LIKE', '%'.$this->searchByKeyword.'%');
            })->when($this->searchByCategory > 0, function ($query) {
                $query->where('category_id', $this->searchByCategory);
            })
            ->paginate(5);

        return view('livewire.blogs', compact('blogs'));
    }

    public function deleteBlog($blogId)
    {
        Blog::find($blogId)->delete();
    }
}
