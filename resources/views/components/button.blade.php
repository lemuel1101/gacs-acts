<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-transparent border border-red-500 rounded-md font-semibold text-xs text-red-500 uppercase tracking-widest hover:bg-gray-600  hover:text-white hover:border-transparent focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-1 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
