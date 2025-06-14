<?php

namespace App\Livewire\Dashboard\Buku;

use App\Models\Authors;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class Tambah extends Component
{
    use WithFileUploads;

    public $naskah_id;
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
    public $naskahList;
    public $draft;
    public $kategori_id;
    public $institusi;
    public $ukuran;
    public $ketersediaan = true;
    public $author_id = null;
    public $categories;
    public $marketplaces = [
        'shopee' => ['active' => false, 'link' => ''],
        'tokopedia' => ['active' => false, 'link' => ''],
        'bukalapak' => ['active' => false, 'link' => ''],
        'lazada' => ['active' => false, 'link' => ''],
    ];
    public $authorList = [];
    public $daftar_isi = '';

    protected $listeners = [
        'set-deskripsi' => 'setDeskripsi',
        'set-sinopsis' => 'setSinopsis',
        'set-daftar-isi' => 'setDaftarIsi',
        'item-selected' => 'handleAuthorSelected'
    ];

    protected function rules()
    {
        $rules = [
            'cover' => 'required|image|max:2048',
            'thumbnail' => 'nullable|image|max:1024',
            'judul' => 'required|min:3',
            'slug' => 'required|unique:buku,slug',
            'deskripsi' => 'required|min:50',
            'sinopsis' => 'required|min:50',
            'daftar_isi' => 'required|min:10',
            'isbn' => 'required|unique:buku,isbn',
            'harga' => 'required|numeric|min:0',
            'institusi' => 'nullable|string',
            'ukuran' => 'required|string',
            'ketersediaan' => 'boolean',
            'jumlah_halaman' => 'required|integer|min:1',
            'tanggal_terbit' => 'required|date',
            'draft' => 'nullable|boolean',
            // 'marketplaces' => ['nullable', function ($attribute, $value, $fail) {
            //     $activeMarketplaces = collect($value)->filter(fn($m) => $m['active'])->count();
            //     if ($activeMarketplaces === 0) {
            //         $fail('Pilih minimal 1 marketplace.');
            //     }
            // }],
            'marketplaces' => 'nullable',
            'authorList' => 'required',
            'author_id' => 'required|exists:authors,id',
        ];

        foreach ($this->marketplaces as $marketplace => $data) {
            if ($data['active']) {
                $rules["marketplaces.{$marketplace}.link"] = 'required|url';
            }
        }

        return $rules;
    }

    protected $messages = [
        'cover.required' => 'Cover buku harus diunggah.',
        'cover.image' => 'Cover buku harus berupa gambar.',
        'cover.max' => 'Ukuran gambar cover buku maksimal 2MB.',
        'thumbnail.image' => 'Thumbnail buku harus berupa gambar.',
        'thumbnail.max' => 'Ukuran gambar thumbnail buku maksimal 1MB.',
        'judul.required' => 'Judul buku harus diisi.',
        'judul.min' => 'Judul buku minimal 3 karakter.',
        'slug.required' => 'Slug tidak boleh kosong.',
        'slug.unique' => 'Slug sudah digunakan.',
        'deskripsi.required' => 'Deskripsi buku harus diisi.',
        'deskripsi.min' => 'Deskripsi buku minimal 100 karakter.',
        'sinopsis.required' => 'Sinopsis buku harus diisi.',
        'sinopsis.min' => 'Sinopsis buku minimal 100 karakter.',
        'isbn.required' => 'ISBN buku harus diisi.',
        'isbn.unique' => 'ISBN buku sudah digunakan.',
        'harga.required' => 'Harga buku harus diisi.',
        'harga.numeric' => 'Harga buku harus berupa angka.',
        'harga.min' => 'Harga buku minimal adalah Rp. 10.000.',
        'jumlah_halaman.required' => 'Jumlah halaman buku harus diisi.',
        'jumlah_halaman.integer' => 'Jumlah halaman buku harus berupa angka.',
        'jumlah_halaman.min' => 'Jumlah halaman buku minimal adalah 1.',
        'tanggal_terbit.required' => 'Tanggal terbit buku harus diisi.',
        'tanggal_terbit.date' => 'Tanggal terbit buku harus berupa tanggal.',
        'marketplaces.*.link.required' => 'Link marketplace harus diisi.',
        'marketplaces.*.link.url' => 'Link marketplace harus berupa URL yang valid.',
        'kategori_id.required' => 'Kategori harus dipilih.',
        'ukuran.required' => 'Ukuran buku harus diisi.',
        'authorList.required' => 'Penulis buku harus diisi.',
        'daftar_isi.required' => 'Daftar isi buku harus diisi.',
        'daftar_isi.min' => 'Daftar isi buku minimal 10 karakter.',
    ];

    public function mount()
    {
        $this->categories = Kategori::all();
        $this->authorList = Authors::all()
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedJudul($value)
    {
        $baseSlug = Str::slug($value);
        $slug = $baseSlug;
        $counter = 1;

        while (Buku::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $this->slug = $slug;
    }

    public function handleAuthorSelected($data)
    {
        if ($data['name'] === 'author') {
            $this->author_id = $data['value'];
            $author = Authors::find($data['value']);
            if ($author) {
                $this->institusi = $author->institusi ?? null;
            }
        }
    }

    public function setDeskripsi($content)
    {
        $this->deskripsi = $content;
    }

    public function setSinopsis($content)
    {
        $this->sinopsis = $content;
    }

    public function setDaftarIsi($content)
    {
        $this->daftar_isi = $content;
    }

    public function save()
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dispatch('notify', message: $e->validator->errors()->first(), type: 'error');
            return;
        }

        try {
            DB::beginTransaction();

            $coverPath = null;
            $thumbnailPath = null;

            if ($this->cover) {
                $coverPath = $this->cover->store('assets/img/books/covers', 'public');
            }

            if ($this->thumbnail) {
                $thumbnailPath = $this->thumbnail->store('assets/img/books/covers/thumbnails', 'public');
            }

            $marketplaceLinks = collect($this->marketplaces)
                ->filter(fn($m) => $m['active'])
                ->map(fn($m) => $m['link'])
                ->toArray();

            $buku = Buku::create([
                'author_id' => $this->author_id,
                'kategori_id' => $this->kategori_id,
                'cover' => $coverPath,
                'cover_thumbnail' => $thumbnailPath,
                'judul' => $this->judul,
                'slug' => $this->slug,
                'deskripsi' => $this->deskripsi,
                'sinopsis' => $this->sinopsis,
                'daftar_isi' => $this->daftar_isi,
                'isbn' => $this->isbn,
                'harga' => $this->harga,
                'institusi' => $this->institusi,
                'ukuran' => $this->ukuran,
                'ketersediaan' => $this->ketersediaan,
                'jumlah_halaman' => $this->jumlah_halaman,
                'tanggal_terbit' => $this->tanggal_terbit,
                'marketplace_links' => json_encode($marketplaceLinks),
                'status' => $this->draft ? false : true
            ]);

            DB::commit();

            $this->reset([
                'cover',
                'thumbnail',
                'judul',
                'slug',
                'deskripsi',
                'sinopsis',
                'isbn',
                'harga',
                'jumlah_halaman',
                'tanggal_terbit',
                'tempImage'
            ]);

            session()->flash('success', 'Buku berhasil disimpan.');

            return $this->redirect(route('semuaBuku'));
        } catch (\Exception $e) {
            DB::rollBack();

            $this->dispatch('notify', message: "Terjadi kesalahan saat menyimpan buku: {$e->getMessage()}", type: 'error');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.buku.tambah');
    }
}
