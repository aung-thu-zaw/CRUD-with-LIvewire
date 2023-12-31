<?php

namespace App\Livewire;

use App\Livewire\Forms\BlogForm;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class BlogCreate extends Component
{
    use WithFileUploads;

    public BlogForm $form;

    public $categories;

    public function mount(): void
    {
        $this->categories = Category::pluck('name', 'id');
    }

    public function save(): void
    {
        $this->form->save();

        $this->redirect('/blogs');
    }

    public function render()
    {
        return view('livewire.blog-create');
    }
}
