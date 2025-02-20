@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-neutral-300 focus:border-red-500 focus:ring-red-500 rounded-lg']) }}>
