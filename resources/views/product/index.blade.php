<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Report page') }}
                    </h2>
                </div>
            </div>
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <x-dark-link-button route="{{ route('clients.create') }}" text="Export to CSV"></x-dark-link-button>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('product.partials.product-list-table')
            </div>
        </div>
    </div>
</x-app-layout>
