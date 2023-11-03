<?php

namespace App\Livewire;

use App\Livewire\Forms\BlogForm;
use App\Models\Blog;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class BlogEdit extends Component
{
    use WithFileUploads;

    public BlogForm $form;

    public $categories;

    public function mount(Blog $blog): void
    {
        $this->form->setBlog($blog);
        $this->categories = Category::pluck('name', 'id');
    }

    public function save(): void
    {
        $this->form->update();

        $this->redirect('/blogs');
    }

    public function render()
    {
        return view('livewire.blog-create');
    }
}
