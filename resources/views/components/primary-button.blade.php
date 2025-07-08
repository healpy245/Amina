<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-boutique-700 dark:bg-boutique-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-boutique-800 uppercase tracking-widest hover:bg-boutique-600 dark:hover:bg-boutique-300 focus:bg-boutique-600 dark:focus:bg-boutique-300 active:bg-boutique-800 dark:active:bg-boutique-400 focus:outline-none focus:ring-2 focus:ring-boutique-500 focus:ring-offset-2 dark:focus:ring-offset-boutique-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
