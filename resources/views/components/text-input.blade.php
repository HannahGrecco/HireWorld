@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white/5 border border-white/10 text-white placeholder-white/30 focus:border-cyan-400 focus:ring-cyan-400 rounded-lg shadow-sm w-full px-3 py-2 text-sm transition']) }}>
