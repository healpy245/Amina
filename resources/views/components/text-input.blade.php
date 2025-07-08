@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm']) }}>
