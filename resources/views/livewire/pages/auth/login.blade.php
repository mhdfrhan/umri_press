<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: false);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember" class="inline-flex items-center cursor-pointer">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded-sm border-gray-300 text-red-600 shadow-xs focus:ring-red-500 duration-200" name="remember">
                <span class="ms-2 text-sm text-gray-600 select-none">{{ __('Ingat saya') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-neutral-500 text-center hover:underline block" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        {{-- <div class="mt-3">
            <p class="text-center text-neutral-500 text-sm">Belum memiliki akun? <a href="{{ route('register') }}" class="text-red-600 hover:underline" wire:navigate>Daftar sekarang</a></p>
        </div> --}}
    </form>
</div>
