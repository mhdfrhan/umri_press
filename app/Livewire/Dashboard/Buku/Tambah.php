<?php

namespace App\Livewire\Dashboard\Buku;

use App\Models\Buku;
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
    public $marketplaces = [
        'shopee' => ['active' => false, 'link' => ''],
        'tokopedia' => ['active' => false, 'link' => ''],
        'bukalapak' => ['active' => false, 'link' => ''],
        'lazada' => ['active' => false, 'link' => ''],
    ];

    protected function rules()
    {
        $rules = [
            'cover' => 'required|image|max:2048',
            'thumbnail' => 'nullable|image|max:1024',
            'judul' => 'required|min:3',
            'slug' => 'required|unique:buku,slug',
            'deskripsi' => 'required|min:100',
            'sinopsis' => 'required|min:100',
            'isbn' => 'required|unique:buku,isbn',
            'harga' => 'required|numeric|min:10000',
            'jumlah_halaman' => 'required|integer|min:1',
            'tanggal_terbit' => 'required|date',
            'draft' => 'nullable|boolean',
            'marketplaces' => ['required', function ($attribute, $value, $fail) {
                $activeMarketplaces = collect($value)->filter(fn($m) => $m['active'])->count();
                if ($activeMarketplaces === 0) {
                    $fail('Pilih minimal 1 marketplace.');
                }
            }],
        ];

        // Add validation rules for active marketplace links
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
    ];

    public function updatedJudul($value)
    {
        $baseSlug = Str::slug($value);
        $slug = $baseSlug;
        $counter = 1;

        // Check if slug exists and increment counter if needed
        while (Buku::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $this->slug = $slug;
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
                // Store the full-size cover
                $coverPath = $this->cover->store('assets/img/covers', 'public');
            }

            if ($this->thumbnail) {
                // Store the thumbnail
                $thumbnailPath = $this->thumbnail->store('assets/img/covers/thumbnails', 'public');
            }

            // Create the book record with marketplace links
            $marketplaceLinks = collect($this->marketplaces)
                ->filter(fn($m) => $m['active'])
                ->map(fn($m) => $m['link'])
                ->toArray();

            $buku = Buku::create([
                'naskah_id' => $this->naskah_id,
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
                'status' => $this->draft ? false : true
            ]);

            DB::commit();

            // Reset form
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

            // Show success notification
            session()->flash('success', 'Buku berhasil disimpan.');

            // Redirect to book list or detail page
            return redirect()->route('semuaBuku');
        } catch (\Exception $e) {
            DB::rollBack();

            // Show error notification
            $this->dispatch('notify', message: "Terjadi kesalahan saat menyimpan buku: {$e->getMessage()}", type: 'error');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.buku.tambah');
    }
}
