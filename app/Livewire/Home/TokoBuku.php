<?php

namespace App\Livewire\Home;

use App\Models\Buku;
use Livewire\Component;
use Livewire\WithPagination;

class TokoBuku extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'newest';
    public $selectedBook = null;
    public $marketplaceLinks = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'newest'],
    ];

    public function showDetail($slug)
    {
        $this->selectedBook = Buku::where('slug', $slug)->firstOrFail();
        $this->dispatch('open-modal', 'detailModal');
    }

    public function showMarketplaces($slug)
    {
        $book = Buku::where('slug', $slug)->firstOrFail();
        $this->marketplaceLinks = json_decode($book->marketplace_links, true);
        $this->selectedBook = $book;
        $this->dispatch('open-modal', 'marketplacesModal');
    }

    public function getBooks()
    {
        $query = Buku::where('status', true);

        // Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('judul', 'like', '%' . $this->search . '%')
                    ->orWhere('isbn', 'like', '%' . $this->search . '%');
            });
        }

        // Sorting
        switch ($this->sortBy) {
            case 'price_low':
                $query->orderBy('harga', 'asc');
                break;
            case 'price_high':
                $query->orderBy('harga', 'desc');
                break;
            case 'title_asc':
                $query->orderBy('judul', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('judul', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        return $query->paginate(20);
    }

    public function render()
    {
        return view('livewire.home.toko-buku', [
            'books' => $this->getBooks()
        ]);
    }
}
