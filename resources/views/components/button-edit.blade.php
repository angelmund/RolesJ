<a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center px-3 py-1 bg-orange-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-400 focus:bg-orange-500 active:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-700 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
