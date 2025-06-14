<?php

namespace App\Livewire\Dashboard\Authors;

use App\Models\Authors;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class SemuaAuthors extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'newest';
    public $showDeleteModal = false;
    public $authorId;
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'required|min:10',
    ];

    protected $messages = [
        'name.required' => 'Nama penulis harus diisi.',
        'name.min' => 'Nama penulis minimal 3 karakter.',
        'description.required' => 'Deskripsi penulis harus diisi.',
        'description.min' => 'Deskripsi penulis minimal 10 karakter.',
    ];

    public function save()
    {
        $this->validate();

        try {
            Authors::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'description' => $this->description,
            ]);

            $this->reset(['name', 'description']);
            $this->dispatch('notify', message: "Penulis berhasil ditambahkan.", type: 'success');
            $this->dispatch('close-modal', 'authorModal'); 
        } catch (\Exception $e) {
            $this->dispatch('notify', message: "Terjadi kesalahan saat menambahkan penulis.", type: 'error');
            $this->dispatch('close-modal', 'authorModal'); 
        }
    }

    public function edit($id)
    {
        $author = Authors::find($id);
        $this->authorId = $author->id;
        $this->name = $author->name;
        $this->description = $author->description;
    }

    public function update()
    {
        $this->validate();

        try {
            $author = Authors::find($this->authorId);
            $author->update([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'description' => $this->description,
            ]);

            $this->reset(['authorId', 'name', 'description']);
            $this->dispatch('close-modal', 'authorModal');
            $this->dispatch('notify', message: "Penulis berhasil diperbarui.", type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('notify', message: "Terjadi kesalahan saat memperbarui penulis.", type: 'error');
            $this->dispatch('close-modal', 'authorModal');
        }

    }

    public function resetForm()
    {
        $this->reset(['authorId', 'name', 'description']);
        $this->resetValidation();
    }

    public function confirmDelete($id)
    {
        $this->authorId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        try {
            Authors::find($this->authorId)->delete();
            $this->reset(['authorId']);
            $this->dispatch('close-modal', 'showDeleteModal');
            $this->dispatch('notify', message: "Penulis berhasil dihapus.", type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('close-modal', 'showDeleteModal');
            $this->dispatch('notify', message: "Terjadi kesalahan saat menghapus penulis.", type: 'error');
        }
    }

    public function closeModal()
    {
        $this->reset(['authorId', 'name', 'description']);
        $this->resetValidation();
    }

    public function render()
    {
        $query = Authors::withCount('buku');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        switch ($this->sortBy) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        return view('livewire.dashboard.authors.semua-authors', [
            'authors' => $query->paginate(10)
        ]);
    }
}