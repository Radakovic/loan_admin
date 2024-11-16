<x-app-layout>
    <x-slot name="header">
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
                    <x-dark-link-button route="{{ route('clients.create') }}" text="Create client"></x-dark-link-button>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('client.partials.client-list-table')
            </div>
        </div>
    </div>

{{--    <div class="space-y-6">--}}
{{--        <x-modal name="confirm-client-deletion" focusable>--}}
{{--            <form method="post" action="#" class="p-6">--}}
{{--                @csrf--}}
{{--                @method('delete')--}}

{{--                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">--}}
{{--                    {{ __('Are you sure you want to delete your client?') }}--}}
{{--                </h2>--}}

{{--                <div class="mt-6 flex justify-end">--}}
{{--                    <x-secondary-button x-on:click="$dispatch('close')">--}}
{{--                        {{ __('Cancel') }}--}}
{{--                    </x-secondary-button>--}}

{{--                    <x-danger-button class="ms-3">--}}
{{--                        {{ __('Delete Account') }}--}}
{{--                    </x-danger-button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </x-modal>--}}
{{--    </div>--}}
</x-app-layout>
