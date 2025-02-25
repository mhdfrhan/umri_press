<?php

namespace App\Livewire\Dashboard\Buku;

use App\Models\Buku;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EditBuku extends Component
{
    use WithFileUploads;

    public $buku;
    public $newCover;
    public $thumbnail;
    public $existingCover;
    public $judul;
    public $slug;
    public $deskripsi;
    public $sinopsis;
    public $isbn;
    public $harga;
    public $jumlah_halaman;
    public $tanggal_terbit;
    public $status;
    public $tempImage;
    public $marketplaces = [
        'shopee' => ['active' => false, 'link' => ''],
        'tokopedia' => ['active' => false, 'link' => ''],
        'bukalapak' => ['active' => false, 'link' => ''],
        'lazada' => ['active' => false, 'link' => '']
    ];

    protected function rules()
    {
        return [
            'newCover' => $this->newCover ? 'image|max:2048' : '',
            'thumbnail' => $this->thumbnail ? 'image|max:1024' : '',
            'judul' => 'required|min:3',
            'slug' => 'required|unique:buku,slug,' . $this->buku->id,
            'deskripsi' => 'required|min:100',
            'sinopsis' => 'required|min:100',
            'isbn' => 'required|unique:buku,isbn,' . $this->buku->id,
            'harga' => 'required|numeric|min:10000',
            'jumlah_halaman' => 'required|integer|min:1',
            'tanggal_terbit' => 'required|date',
            'marketplaces' => ['required', function ($attribute, $value, $fail) {
                $activeMarketplaces = collect($value)->filter(fn($m) => $m['active'])->count();
                if ($activeMarketplaces === 0) {
                    $fail('Pilih minimal 1 marketplace.');
                }
            }]
        ];
    }

    public function mount(Buku $buku)
    {
        $this->buku = $buku;
        $this->existingCover = $buku->cover;
        $this->judul = $buku->judul;
        $this->slug = $buku->slug;
        $this->deskripsi = $buku->deskripsi;
        $this->sinopsis = $buku->sinopsis;
        $this->isbn = $buku->isbn;
        $this->harga = $buku->harga;
        $this->jumlah_halaman = $buku->jumlah_halaman;
        $this->tanggal_terbit = $buku->tanggal_terbit;
        $this->status = $buku->status;

        // Load marketplace data
        $marketplaceLinks = json_decode($buku->marketplace_links, true) ?? [];
        foreach ($marketplaceLinks as $marketplace => $link) {
            if (isset($this->marketplaces[$marketplace])) {
                $this->marketplaces[$marketplace] = [
                    'active' => true,
                    'link' => $link
                ];
            }
        }

    }

    public function updatedJudul($value)
    {
        if ($this->judul !== $this->buku->judul) {
            $baseSlug = Str::slug($value);
            $slug = $baseSlug;
            $counter = 1;

            while (Buku::where('slug', $slug)
                ->where('id', '!=', $this->buku->id)
                ->exists()
            ) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $this->slug = $slug;
        }
    }

    public function save()
    {
        try {
            $this->validate();

            DB::beginTransaction();

            $coverPath = $this->existingCover;
            $thumbnailPath = $this->buku->cover_thumbnail;

            if ($this->newCover) {
                // Delete old images
                if ($this->buku->cover) {
                    Storage::disk('public')->delete($this->buku->cover);
                }
                if ($this->buku->cover_thumbnail) {
                    Storage::disk('public')->delete($this->buku->cover_thumbnail);
                }

                // Store new images
                $coverPath = $this->newCover->store('assets/img/covers', 'public');
                $thumbnailPath = $this->thumbnail->store('assets/img/covers/thumbnails', 'public');
            }

            // Update marketplace links
            $marketplaceLinks = collect($this->marketplaces)
                ->filter(fn($m) => $m['active'])
                ->map(fn($m) => $m['link'])
                ->toArray();

            $this->buku->update([
                'cover' => $coverPath,
                'cover_thumbnail' => $thumbnailPath,
                'judul' => $this->judul,
                'slug' => $this->slug,
                'deskripsi' => $this->deskripsi,
                'sinopsis' => $this->sinopsis,
                'isbn' => $this->isbn,
                'harga' => $this->harga,
                'jumlah_halaman' => $this->jumlah_halaman,
                'tanggal_terbit' => $this->tanggal_terbit,
                'marketplace_links' => json_encode($marketplaceLinks),
                'status' => $this->status
            ]);

            DB::commit();

            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Buku berhasil diperbarui!'
            ]);

            return redirect()->route('semuaBuku');
        } catch (ValidationException $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => $e->validator->errors()->first()
            ]);
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => "Terjadi kesalahan: {$e->getMessage()}"
            ]);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.buku.edit-buku');
    }
}
