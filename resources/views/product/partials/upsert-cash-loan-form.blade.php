<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Cash loan product Information') }}
        </h2>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Cash credit is issued only in amounts between 1.000 and 10.000 euros.') }}
        </div>
    </header>

    <form method="post" action="{{ route('products.updateCashLoan', ['product' => $cashLoan->id ?? '']) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Cash loan amount -->
        @if ($cashLoan === null)
            <div>
                <x-input-label for="cash_loan_amount" :value="__('Cash amount in euros')" />
                <x-text-input
                        id="cash_loan_amount"
                        class="block mt-1 w-full"
                        type="number"
                        name="cash_loan_amount"
                        :value="old('cash_loan_amount')"
                />
                <x-input-error :messages="$errors->get('cash_loan_amount')" class="mt-2" />
            </div>
            <input type="hidden" name="type" value="CASH_LOAN">
            <input type="hidden" name="client_id" value="{{ $client->id }}">
            <input type="hidden" name="adviser_id" value="{{ $adviser->id }}">

            <div class="flex items-center justify-end mt-4">
                <x-danger-button class="ms-4">
                    {{ __('Save') }}
                </x-danger-button>
            </div>
        @else
            @if ($adviser->id === $cashLoan->adviser->id)
                <div>
                    <x-input-label for="cash_loan_amount" :value="__('Cash amount in euros')" />
                    <x-text-input
                            id="cash_loan_amount"
                            class="block mt-1 w-full"
                            type="number"
                            name="cash_loan_amount"
                            :value="old('cash_loan_amount', round($cashLoan->cash_loan_amount / 100))"
                    />
                    <x-input-error :messages="$errors->get('cash_loan_amount')" class="mt-2" />
                </div>

                <input type="hidden" name="type" value="CASH_LOAN">
                <input type="hidden" name="client_id" value="{{ $client->id }}">
                <input type="hidden" name="adviser_id" value="{{ $cashLoan->adviser->id }}">

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
                        name="cash_loan_amount"
                        value={{ round($cashLoan->cash_loan_amount / 100) }}
                        readonly
                />

                <div class="mb-4 text-sm text-red-500 dark:text-red-400">
                    {{ __('You did not create this product, so you are not able to edit it.') }}
                </div>
            @endif
        @endif
    </form>
</section>
