<?php

namespace App\Livewire\Dashboard\Harga;

use App\Models\PaketPenerbit;
use Livewire\Component;
use Illuminate\Support\Str;

class EditHarga extends Component
{
    public $paketId;
    public $nama;
    public $jumlah_eksemplar;
    public $harga;
    public $features = [];
    public $recommended;
    public $active;
    public $slug;

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

    public function mount($slug)
    {
        $paket = PaketPenerbit::where('slug', $slug)->firstOrFail();
        $this->paketId = $paket->id;
        $this->nama = $paket->nama;
        $this->jumlah_eksemplar = $paket->jumlah_eksemplar;
        $this->harga = $paket->harga;
        $this->features = $paket->fitur;
        $this->recommended = $paket->recommended;
        $this->active = $paket->active;
        $this->slug = $paket->slug;
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
            $paket = PaketPenerbit::find($this->paketId);

            if ($this->recommended) {
                PaketPenerbit::where('id', '!=', $this->paketId)
                    ->where('recommended', true)
                    ->update(['recommended' => false]);
            }

            $paket->update([
                'nama' => $this->nama,
                'slug' => Str::slug($this->nama),
                'jumlah_eksemplar' => $this->jumlah_eksemplar,
                'harga' => $this->harga,
                'fitur' => $this->features,
                'recommended' => $this->recommended,
                'active' => $this->active,
            ]);

            session()->flash('success', 'Paket berhasil diperbarui!');
            return $this->redirect(route('semuaPaket'), navigate: true);
        } catch (\Exception $e) {
            $this->dispatch('notify', message: "Gagal memperbarui paket. {$e->getMessage()}", type: 'error');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.harga.edit-harga');
    }
}