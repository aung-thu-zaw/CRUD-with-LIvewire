<?php

namespace App\Livewire;

use App\Models\Blog;
use App\Models\Category;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class BlogCreate extends Component
{
    use WithFileUploads;

    #[Rule('required|min:3')]
    public string $title = '';

    #[Rule('required|min:3')]
    public string $content = '';

    #[Rule('required|exists:categories,id', as: 'category')]
    public int $category_id;

    #[Rule('required|in:draft,published')]
    public string $status;

    #[Rule('image|max:1024')] // 1MB Max
    public $thumbnail;

    public $categories;

    public function mount(): void
    {
        $this->categories = Category::pluck('name', 'id');
    }

    public function save(): void
    {
        $this->validate();

        $finalName = $this->thumbnail->getClientOriginalName();

        $this->thumbnail->storeAs('blogs', $finalName);

        Blog::create([
            'category_id' => $this->category_id,
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'thumbnail' => $finalName
        ]);

        $this->redirect('/blogs');
    }

    public function render()
    {
        return view('livewire.blog-create');
    }
}
