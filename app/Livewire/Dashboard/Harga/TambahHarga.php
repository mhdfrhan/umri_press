<?php

namespace App\Livewire\Dashboard\Harga;

use App\Models\PaketPenerbit;
use Livewire\Component;
use Illuminate\Support\Str;

class TambahHarga extends Component
{
    public $nama;
    public $jumlah_eksemplar;
    public $harga;
    public $features = [];
    public $recommended = false;
    public $active = true;

    protected function rules()
    {
        return [
            'nama' => 'required|string|min:3|max:255',
            'jumlah_eksemplar' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'features' => 'required|array|min:1',
            'features.*' => 'required|string|min:3',
            'recommended' => 'boolean',
            'active' => 'boolean',
        ];
    }

    protected $messages = [
        'nama.required' => 'Nama paket harus diisi.',
        'jumlah_eksemplar.required' => 'Jumlah eksemplar harus diisi.',
        'harga.required' => 'Harga harus diisi.',
        'features.required' => 'Minimal satu fitur harus diisi.',
        'features.*.required' => 'Fitur tidak boleh kosong.',
    ];

    public function mount()
    {
        $this->features = [
            'ISBN dan Barcode',
            'Layout dan Design Cover',
            'Editing & Proofreading',
            'Distribusi ke Toko Buku',
            'E-book Format',
            'Marketing Support'
        ];
    }

    public function addFeature()
    {
        $this->features[] = '';
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function save()
    {
        $this->validate();

        try {
            $lastPosition = PaketPenerbit::max('position') ?? 0;

            if ($this->recommended) {
                PaketPenerbit::where('recommended', true)->update(['recommended' => false]);
            }

            PaketPenerbit::create([
                'nama' => $this->nama,
                'slug' => Str::slug($this->nama),
                'jumlah_eksemplar' => $this->jumlah_eksemplar,
                'harga' => $this->harga,
                'fitur' => $this->features,
                'recommended' => $this->recommended,
                'active' => $this->active,
                'position' => $lastPosition + 1,
            ]);

            session()->flash('success', 'Paket berhasil ditambahkan!');
            return $this->redirect(route('semuaPaket'), navigate: true);
        } catch (\Exception $e) {
            $this->dispatch('notify', message: "Gagal menambahkan paket. {$e->getMessage()}", type: 'error');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.harga.tambah-harga');
    }
}
