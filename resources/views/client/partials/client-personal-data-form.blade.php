<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Client Information') }}
        </h2>
    </header>

    <form method="post" action="{{ route('clients.update', ['client' => $client->id]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- First name -->
        <div>
            <x-input-label for="first_name" :value="__('First name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name', $client->first_name)" autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>
        <!-- Last name -->
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Last name')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name', $client->last_name)" autofocus autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $client->email)" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Phone number -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone number')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone', $client->phone)" autocomplete="phone" placeholder="123-45-678" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-danger-button class="ms-4">
                {{ __('Save') }}
            </x-danger-button>
        </div>
    </form>
</section>
