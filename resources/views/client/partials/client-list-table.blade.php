<table class="border-collapse border border-slate-500 w-full">
    <thead>
    <tr>
        <th class="border border-slate-600 px-4 py-2 text-gray-800 dark:text-gray-200">First name</th>
        <th class="border border-slate-600 px-4 py-2 text-gray-800 dark:text-gray-200">Last name</th>
        <th class="border border-slate-600 px-4 py-2 text-gray-800 dark:text-gray-200">Email</th>
        <th class="border border-slate-600 px-4 py-2 text-gray-800 dark:text-gray-200">Phone</th>
        <th class="border border-slate-600 px-4 py-2 text-gray-800 dark:text-gray-200">Cash loan</th>
        <th class="border border-slate-600 px-4 py-2 text-gray-800 dark:text-gray-200">Home loan</th>
        <th class="border border-slate-600 px-4 py-2 text-gray-800 dark:text-gray-200">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
            <tr>
                <td class="border border-slate-700 px-4 py-2 text-gray-800 dark:text-gray-200">{{ $client->first_name }}</td>
                <td class="border border-slate-700 px-4 py-2 text-gray-800 dark:text-gray-200">{{ $client->last_name }}</td>
                <td class="border border-slate-700 px-4 py-2 text-gray-800 dark:text-gray-200">{{ $client->email }}</td>
                <td class="border border-slate-700 px-4 py-2 text-gray-800 dark:text-gray-200">{{ $client->phone }}</td>
                <td class="border border-slate-700 px-4 py-2 text-gray-800 dark:text-gray-200">{{ $client->cashLoan ? 'YES' : 'NO' }}</td>
                <td class="border border-slate-700 px-4 py-2 text-gray-800 dark:text-gray-200">{{ $client->homeLoan ? 'YES' : 'NO' }}</td>
                <td class="border border-slate-700 px-4 py-2 text-gray-800 dark:text-gray-200">
                    <x-dark-link-button route="{{ $client->id }}" text="{{ __('Edit') }}"></x-dark-link-button>
{{--                    <x-red-link-button route="{{ route('clients.destroy', ['client' => $client->id]) }}" text="{{ __('Delete') }}"></x-red-link-button>--}}
                    <form method="post" action="{{ route('clients.destroy', ['client' => $client->id]) }}" style="display: inline">
                        @csrf
                        @method('delete')

                        <x-danger-button>
                            {{ __('Delete') }}
                        </x-danger-button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
