<?php

namespace App\Livewire\Forms;

use App\Models\Blog;
use Livewire\Attributes\Rule;
use Livewire\Form;

class BlogForm extends Form
{
    public ?Blog $blog;

    #[Rule('required|min:3')]
    public string $title = '';

    #[Rule('required|min:3')]
    public string $content = '';

    #[Rule('required|exists:categories,id', as: 'category')]
    public int $category_id;

    #[Rule('required|in:draft,published')]
    public string $status;

    #[Rule('nullable|image|max:1024')] // 1MB Max
    public $thumbnail;

    public function setBlog(Blog $blog)
    {
        $this->blog = $blog;
        $this->category_id = $blog->category_id;
        $this->title = $blog->title;
        $this->content = $blog->content;
        $this->status = $blog->status;
        // $this->thumbnail = $blog->thumbnail;
    }

    public function save()
    {
        $this->validate();

        $finalName = $this->thumbnail->getClientOriginalName();

        $this->thumbnail->storeAs('blogs', $finalName);

        Blog::create([
            'category_id' => $this->category_id,
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'thumbnail' => $finalName,
        ]);
    }

    public function update(): void
    {
        $this->validate();

        $this->blog->update($this->all());
    }
}
