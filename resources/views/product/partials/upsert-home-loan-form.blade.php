<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Home loan product Information') }}
        </h2>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Home credit is issued in amounts between 10.000 and 1.000.000 euros.') }}
            {{ __('Down payment amount can be amount between 1.000 and 100.000 euros.') }}
        </div>
    </header>

    <form method="post" action="{{ route('products.updateHomeLoan', ['product' => $homeLoan->id ?? '']) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Home loan amount -->
        @if ($homeLoan === null)
            <div>
                <x-input-label for="property_value" :value="__('Property value in euros')" />
                <x-text-input
                        id="property_value"
                        class="block mt-1 w-full"
                        type="number"
                        name="property_value"
                        :value="old('property_value')"
                />
                <x-input-error :messages="$errors->get('property_value')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="down_payment_amount" :value="__('Down payment amount value in euros')" />
                <x-text-input
                        id="down_payment_amount"
                        class="block mt-1 w-full"
                        type="number"
                        name="down_payment_amount"
                        :value="old('down_payment_amount')"
                />
                <x-input-error :messages="$errors->get('down_payment_amount')" class="mt-2" />
            </div>

            <input type="hidden" name="type" value="HOME_LOAN">
            <input type="hidden" name="client_id" value="{{ $client->id }}">
            <input type="hidden" name="adviser_id" value="{{ $adviser->id }}">

            <div class="flex items-center justify-end mt-4">
                <x-danger-button class="ms-4">
                    {{ __('Save') }}
                </x-danger-button>
            </div>
        @else
            @if ($adviser->id === $homeLoan->adviser->id)
                <div>
                    <x-input-label for="property_value" :value="__('Property value in euros')" />
                    <x-text-input
                            id="property_value"
                            class="block mt-1 w-full"
                            type="number"
                            name="property_value"
                            :value="old('property_value', round($homeLoan->property_value / 100))"
                    />
                    <x-input-error :messages="$errors->get('property_value')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="down_payment_amount" :value="__('Down payment amount value in euros')" />
                    <x-text-input
                            id="down_payment_amount"
                            class="block mt-1 w-full"
                            type="number"
                            name="down_payment_amount"
                            :value="old('down_payment_amount', round($homeLoan->down_payment_amount / 100))"
                    />
                    <x-input-error :messages="$errors->get('down_payment_amount')" class="mt-2" />
                </div>

                <input type="hidden" name="type" value="HOME_LOAN">
                <input type="hidden" name="client_id" value="{{ $client->id }}">
                <input type="hidden" name="adviser_id" value="{{ $homeLoan->adviser->id }}">

                <x-input-error :messages="$errors->all()" class="mt-2" />

                <div class="flex items-center justify-end mt-4">
                    <x-danger-button class="ms-4">
                        {{ __('Save') }}
                    </x-danger-button>
                </div>
            @else
                <input
                        class="block mt-1 w-full text-gray-900 dark:text-gray-100"
                        style="background-color: rgb(55 65 81 / var(--tw-border-opacity, 1));"
                        type="text"
                        name="property_value"
                        value={{ round($homeLoan->property_value / 100) }}
                        readonly
                />

                <input
                        class="block mt-1 w-full text-gray-900 dark:text-gray-100"
                        style="background-color: rgb(55 65 81 / var(--tw-border-opacity, 1));"
                        type="text"
                        name="cash_loan_amount"
                        value={{ round($homeLoan->down_payment_amount / 100) }}
                        readonly
                />

                <div class="mb-4 text-sm text-red-500 dark:text-red-400">
                    {{ __('You did not create this product, so you are not able to edit it.') }}
                </div>
            @endif
        @endif
    </form>
</section>
