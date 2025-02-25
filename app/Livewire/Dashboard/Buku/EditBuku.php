<?php

namespace App\Livewire\Dashboard\Buku;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditBuku extends Component
{
    use WithFileUploads;

    public $bukuId;
    public $cover;
    public $thumbnail;
    public $judul = '';
    public $slug = '';
    public $deskripsi = '';
    public $sinopsis = '';
    public $isbn;
    public $harga;
    public $jumlah_halaman;
    public $tanggal_terbit;
    public $tempImage;
    public $draft;
    public $kategori_id;
    public $penulis;
    public $institusi;
    public $ukuran;
    public $ketersediaan = true;
    public $categories;
    public $oldCover;
    public $oldThumbnail;
    public $marketplaces = [
        'shopee' => ['active' => false, 'link' => ''],
        'tokopedia' => ['active' => false, 'link' => ''],
        'bukalapak' => ['active' => false, 'link' => ''],
        'lazada' => ['active' => false, 'link' => ''],
    ];

    protected $listeners = [
        'set-deskripsi' => 'setDeskripsi',
        'set-sinopsis' => 'setSinopsis'
    ];

    public function mount(Buku $buku)
    {
        $this->bukuId = $buku->id;
        $this->judul = $buku->judul;
        $this->slug = $buku->slug;
        $this->deskripsi = $buku->deskripsi;
        $this->sinopsis = $buku->sinopsis;
        $this->isbn = $buku->isbn;
        $this->harga = $buku->harga;
        $this->jumlah_halaman = $buku->jumlah_halaman;
        $this->tanggal_terbit = $buku->tanggal_terbit;
        $this->kategori_id = $buku->kategori_id;
        $this->penulis = $buku->penulis;
        $this->institusi = $buku->institusi;
        $this->ukuran = $buku->ukuran;
        $this->ketersediaan = $buku->ketersediaan;
        $this->draft = !$buku->status;
        $this->oldCover = $buku->cover;
        $this->oldThumbnail = $buku->cover_thumbnail;
        $this->categories = Kategori::all();

        if ($buku->marketplace_links) {
            $marketplaceLinks = json_decode($buku->marketplace_links, true);
            foreach ($marketplaceLinks as $platform => $link) {
                if (isset($this->marketplaces[$platform])) {
                    $this->marketplaces[$platform] = [
                        'active' => true,
                        'link' => $link
                    ];
                }
            }
        }
    }

    protected function rules()
    {
        return [
            'cover' => 'nullable|image|max:2048',
            'thumbnail' => 'nullable|image|max:1024',
            'judul' => 'required|min:3',
            'slug' => 'required|unique:buku,slug,' . $this->bukuId,
            'deskripsi' => 'required|min:100',
            'sinopsis' => 'required|min:100',
            'isbn' => 'required|unique:buku,isbn,' . $this->bukuId,
            'harga' => 'required|numeric|min:10000',
            'jumlah_halaman' => 'required|integer|min:1',
            'tanggal_terbit' => 'required|date',
            'kategori_id' => 'required',
            'penulis' => 'required|min:3',
            'ukuran' => 'required',
            'marketplaces.*.link' => 'required_if:marketplaces.*.active,true|url'
        ];
    }

    public function updatedJudul($value)
    {
        $baseSlug = Str::slug($value);
        $slug = $baseSlug;
        $counter = 1;

        // Check if slug exists and increment counter if needed
        while (Buku::where('slug', $slug)->where('id', '!=', $this->bukuId)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $this->slug = $slug;
    }

    public function setDeskripsi($content)
    {
        $this->deskripsi = $content;
    }

    public function setSinopsis($content)
    {
        $this->sinopsis = $content;
    }

    public function save()
    {
        try {
            $this->validate();

            DB::beginTransaction();

            $buku = Buku::find($this->bukuId);

            $marketplaceLinks = [];
            foreach ($this->marketplaces as $platform => $data) {
                if ($data['active']) {
                    $marketplaceLinks[$platform] = $data['link'];
                }
            }

            if ($this->cover) {
                if ($buku->cover) {
                    Storage::disk('public')->delete($buku->cover);
                }
                $coverPath = $this->cover->store('assets/img/books/covers', 'public');
            }

            if ($this->thumbnail) {
                if ($buku->cover_thumbnail) {
                    Storage::disk('public')->delete($buku->cover_thumbnail);
                }
                $thumbnailPath = $this->thumbnail->store('assets/img/books/thumbnails', 'public');
            }

            $buku->update([
                'judul' => $this->judul,
                'slug' => $this->slug,
                'deskripsi' => $this->deskripsi,
                'sinopsis' => $this->sinopsis,
                'isbn' => $this->isbn,
                'harga' => $this->harga,
                'penulis' => $this->penulis,
                'institusi' => $this->institusi,
                'ukuran' => $this->ukuran,
                'ketersediaan' => $this->ketersediaan,
                'jumlah_halaman' => $this->jumlah_halaman,
                'tanggal_terbit' => $this->tanggal_terbit,
                'kategori_id' => $this->kategori_id,
                'marketplace_links' => json_encode($marketplaceLinks),
                'status' => $this->draft ? false : true,
                'cover' => $this->cover ? $coverPath : $buku->cover,
                'cover_thumbnail' => $this->thumbnail ? $thumbnailPath : $buku->cover_thumbnail,
            ]);

            DB::commit();

            session()->flash('success', 'Buku berhasil diperbarui.');
            return redirect()->route('semuaBuku');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notify', message: "Terjadi kesalahan saat memperbarui buku: {$e->getMessage()}", type: 'error');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.buku.edit-buku');
    }
}
