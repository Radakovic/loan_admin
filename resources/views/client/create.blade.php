<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('New client') }}
                    </h2>
                </div>
            </div>
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <x-dark-link-button route="{{ route('clients.index') }}" text="Go back to clients"></x-dark-link-button>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form method="POST" action="{{ route('clients.store') }}">
                    @csrf
                    <!-- First name -->
                    <div>
                        <x-input-label for="first_name" :value="__('First name')" />
                        <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" autofocus autocomplete="first_name" />
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>
                    <!-- Last name -->
                    <div class="mt-4">
                        <x-input-label for="last_name" :value="__('Last name')" />
                        <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" autofocus autocomplete="last_name" />
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Phone number -->
                    <div class="mt-4">
                        <x-input-label for="phone" :value="__('Phone number')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" autocomplete="phone" placeholder="123-45-678" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-danger-button class="ms-4">
                            {{ __('Save') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
