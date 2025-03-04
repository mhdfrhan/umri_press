<?php

namespace App\Livewire\Dashboard;

use App\Models\Pengaturan as Setting;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Pengaturan extends Component
{
    use WithFileUploads;

    public $settings = [];
    public $images = [];
    public $files = [];

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $settings = Setting::all()->groupBy('group');
        $this->settings = $settings->toArray();
    }

    public function updatedFiles($value, $key)
    {
        try {
            $setting = Setting::where('key', $key)->first();

            if ($setting && $this->files[$key]) {
                $this->validate([
                    "files.$key" => 'required|mimes:pdf|max:10240', 
                ], [
                    "files.$key.required" => 'File PDF harus dipilih.',
                    "files.$key.mimes" => 'File harus berupa PDF.',
                    "files.$key.max" => 'Ukuran file maksimal 10MB.'
                ]);

                if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                    Storage::disk('public')->delete($setting->value);
                }

                $path = $this->files[$key]->store('assets/pdf', 'public');

                $setting->update(['value' => $path]);

                $this->dispatch('notify', message: 'File PDF berhasil diperbarui!', type: 'success');

                $this->loadSettings();
                $this->files = [];
            }
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Gagal memperbarui file PDF: ' . $e->getMessage(), type: 'error');
        }
    }

    public function deletePdf($key)
    {
        try {
            $setting = Setting::where('key', $key)->first();

            if ($setting && $setting->value) {
                if (Storage::disk('public')->exists($setting->value)) {
                    Storage::disk('public')->delete($setting->value);
                }

                $setting->update(['value' => null]);

                $this->dispatch('notify', message: 'File PDF berhasil dihapus!', type: 'success');

                $this->loadSettings();
            }
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Gagal menghapus file PDF: ' . $e->getMessage(), type: 'error');
        }
    }

    public function updatedImages($value, $key)
    {
        try {
            $setting = Setting::where('key', $key)->first();

            if ($setting && $this->images[$key]) {
                if ($setting->value && file_exists(public_path($setting->value))) {
                    unlink(public_path($setting->value));
                }

                $path = $this->images[$key]->store('assets/img/settings', 'public');
                $setting->update(['value' => $path]);

                $this->dispatch('notify', message: 'Gambar berhasil diperbarui!', type: 'success');
                $this->loadSettings();
            }
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Gagal memperbarui gambar: ' . $e->getMessage(), type: 'error');
        }
    }

    public function updateSetting($key, $value)
    {
        try {
            Setting::where('key', $key)->update(['value' => $value]);
            $this->dispatch('notify', message: 'Pengaturan berhasil diperbarui!', type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Gagal memperbarui pengaturan: ' . $e->getMessage(), type: 'error');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.pengaturan');
    }
}
