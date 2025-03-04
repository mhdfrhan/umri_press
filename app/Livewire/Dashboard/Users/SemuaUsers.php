<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class SemuaUsers extends Component
{
    use WithPagination;

    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $search = '';
    public $sortBy = 'newest';
    public $selectedId;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'newest']
    ];

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email',
        ];

        if (!$this->userId) {
            // Rules for new user
            $rules['email'] .= '|unique:users';
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        } else {
            // Rules for existing user - make password optional
            if ($this->password) {
                $rules['password'] = ['required', 'confirmed', Password::defaults()];
            }
        }

        return $rules;
    }

    public function getUsers()
    {
        $query = User::when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        });

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

        return $query->paginate(10);
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->dispatch('open-modal', 'userModal');
    }

    public function edit($id)
    {
        $this->resetForm();
        $this->userId = $id;
        $user = User::find($id);

        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
        }

        $this->dispatch('open-modal', 'userModal');
    }

    public function save()
    {
        $this->validate();

        try {
            $data = [
                'name' => $this->name,
                'email' => $this->email,
            ];

            if ($this->password) {
                $data['password'] = Hash::make($this->password);
            }

            User::updateOrCreate(
                ['id' => $this->userId],
                $data
            );

            $this->dispatch('notify', message: $this->userId ? 'Admin berhasil diperbarui!' : 'Admin berhasil ditambahkan!', type: 'success');
            $this->dispatch('close-modal', 'userModal');
            $this->resetForm();
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Terjadi kesalahan: ' . $e->getMessage(), type: 'error');
        }
    }

    public function confirmDelete($id)
    {
        $user = User::find($id);

        if ($user->id === Auth::id()) {
            $this->dispatch('notify', message: 'Tidak dapat menghapus akun yang sedang login!', type: 'error');
            return;
        }

        if ($user->email === 'umripres@umri.ac.id') {
            $this->dispatch('notify', message: 'Tidak dapat menghapus admin utama!', type: 'error');
            return;
        }

        $this->selectedId = $id;
        $this->dispatch('open-modal', 'confirmDelete');
    }

    public function delete()
    {
        $user = User::find($this->selectedId);

        if ($user && $user->id !== Auth::id() && $user->email !== 'umripres@umri.ac.id') {
            $user->delete();
            $this->dispatch('notify', message: 'Admin berhasil dihapus!', type: 'success');
        }

        $this->dispatch('close-modal', 'confirmDelete');
    }

    private function resetForm()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function render()
    {
        return view('livewire.dashboard.users.semua-users', [
            'users' => $this->getUsers()
        ]);
    }
}
