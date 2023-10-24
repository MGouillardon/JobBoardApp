<div x-data="{ show: false }" x-show="show" x-transition:enter="transition ease-out duration-1000"
    x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90" {{ $attributes->merge(['class' => '']) }}>
    {{ $slot }}
</div>
    