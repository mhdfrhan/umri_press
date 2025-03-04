<?php

namespace App\Livewire\Dashboard;

use App\Models\Pengaturan as Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Pengaturan extends Component
{
    use WithFileUploads;

    public $settings = [];
    public $images = [];

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $settings = Setting::all()->groupBy('group');
        $this->settings = $settings->toArray();
    }

    public function updatedImages($value, $key)
    {
        try {
            $setting = Setting::where('key', $key)->first();
            
            if ($setting && $this->images[$key]) {
                // Validate image
                $this->validate([
                    "images.$key" => 'image|max:2048', // Max 2MB
                ], [
                    "images.$key.image" => 'File harus berupa gambar.',
                    "images.$key.max" => 'Ukuran gambar maksimal 2MB.'
                ]);

                // Delete old image if exists
                if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                    Storage::disk('public')->delete($setting->value);
                }

                // Store new image
                $path = $this->images[$key]->store('assets/img/settings', 'public');

                // If updating logo-white, ensure it's optimized for dark mode
                if ($key === 'logo-white') {
                    // You may want to add additional image processing here
                    // For example, ensuring the background is transparent
                }

                // Update setting
                $setting->update(['value' => $path]);
                
                $this->dispatch('notify', 
                    message: ($key === 'logo-white' ? 'Logo dark mode' : 'Gambar') . ' berhasil diperbarui!', 
                    type: 'success'
                );
                
                $this->loadSettings();
                $this->images = []; // Clear uploaded images
            }
        } catch (\Exception $e) {
            $this->dispatch('notify', 
                message: 'Gagal memperbarui ' . ($key === 'logo-white' ? 'logo dark mode' : 'gambar') . ': ' . $e->getMessage(), 
                type: 'error'
            );
        }
    }

    public function updateSetting($key, $value)
    {
        try {
            Setting::where('key', $key)->update(['value' => $value]);
            
            // Clear logo cache if updating logo settings
            if (in_array($key, ['logo', 'logo-white'])) {
                // You might want to clear any cached logo images here
            }

            $this->dispatch('notify', message: 'Pengaturan berhasil diperbarui!', type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Gagal memperbarui pengaturan: ' . $e->getMessage(), type: 'error');
        }
    }

    public function deleteLogo($key)
    {
        try {
            $setting = Setting::where('key', $key)->first();
            
            if ($setting && $setting->value) {
                if (Storage::disk('public')->exists($setting->value)) {
                    Storage::disk('public')->delete($setting->value);
                }
                
                $setting->update(['value' => null]);
                
                $this->dispatch('notify', 
                    message: ($key === 'logo-white' ? 'Logo dark mode' : 'Logo') . ' berhasil dihapus!', 
                    type: 'success'
                );
                
                $this->loadSettings();
            }
        } catch (\Exception $e) {
            $this->dispatch('notify', 
                message: 'Gagal menghapus ' . ($key === 'logo-white' ? 'logo dark mode' : 'logo') . ': ' . $e->getMessage(), 
                type: 'error'
            );
        }
    }

    public function render()
    {
        return view('livewire.dashboard.pengaturan');
    }
}