<div class="p-6">
    @include('components.alert')

    <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100 mb-6">Pengaturan Website</h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @foreach ($settings as $group => $groupSettings)
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold mb-4 capitalize text-neutral-900 dark:text-neutral-100">
                    {{ $group }}
                </h3>

                <div class="space-y-6">
                    @foreach ($groupSettings as $setting)
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">
                                    {{ $setting['display_name'] }}
                                </label>
                                @if ($setting['keterangan'])
                                    <span class="text-xs text-neutral-500 dark:text-neutral-400">
                                        {{ $setting['keterangan'] }}
                                    </span>
                                @endif
                            </div>

                            @switch($setting['type'])
                                @case('image')
                                    <div>
                                        @if ($setting['value'])
                                            <div
                                                class="{{ $setting['key'] === 'logo-white' ? 'bg-neutral-950 p-4' : '' }} rounded-lg mb-2">
                                                <img src="{{ asset($setting['value']) }}" alt="{{ $setting['display_name'] }}"
                                                    class="h-20 object-contain {{ $setting['key'] === 'logo-white' ? 'mx-auto' : '' }}">
                                            </div>
                                        @endif

                                        <input type="file" wire:model="images.{{ $setting['key'] }}"
                                            class="block w-full text-sm text-neutral-500 dark:text-neutral-400
                file:mr-4 file:py-2 file:px-4 file:rounded-lg
                file:border-0 file:text-sm file:font-medium
                file:bg-cgreen-50 file:text-cgreen-700
                hover:file:bg-cgreen-100
                dark:file:bg-cgreen-900/20 dark:file:text-cgreen-400"
                                            accept="image/*">
                                    </div>
                                @break

                                @case('textarea')
                                    <textarea wire:model.blur="settings.{{ $group }}.{{ $loop->index }}.value"
                                        wire:change="updateSetting('{{ $setting['key'] }}', $event.target.value)"
                                        class="w-full rounded-lg border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 focus:border-cgreen-500 focus:ring-cgreen-500"
                                        rows="3">{{ $setting['value'] }}</textarea>
                                @break

                                @default
                                    <input type="{{ $setting['type'] }}"
                                        wire:model.blur="settings.{{ $group }}.{{ $loop->index }}.value"
                                        wire:change="updateSetting('{{ $setting['key'] }}', $event.target.value)"
                                        class="w-full rounded-lg border-neutral-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 focus:border-cgreen-500 focus:ring-cgreen-500">
                            @endswitch
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
