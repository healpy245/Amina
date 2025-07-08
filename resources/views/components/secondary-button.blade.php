<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-cream-100 dark:bg-neutral-800 border border-boutique-300 dark:border-neutral-500 rounded-md font-semibold text-xs text-boutique-700 dark:text-neutral-300 uppercase tracking-widest shadow-sm hover:bg-cream-200 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-boutique-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
