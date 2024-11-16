<div class="flex justify-between">
    <div class="flex">
        <div class="shrink-0 flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Clients list') }}
            </h2>
        </div>
    </div>
    <div class="flex">
        <div class="shrink-0 flex items-center">
            <a
                    href="{{ route('clients.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
            >
                {{ __('Create client') }}
            </a>
        </div>
    </div>
</div>
