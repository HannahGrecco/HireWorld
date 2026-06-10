<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-2.5 bg-white text-[#080E1A] font-semibold text-sm rounded-lg hover:bg-white/90 focus:outline-none focus:ring-2 focus:ring-white/50 transition']) }}>
    {{ $slot }}
</button>
