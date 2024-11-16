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
                <td class="border border-slate-700 px-4 py-2 text-gray-800 dark:text-gray-200">YES</td>
                <td class="border border-slate-700 px-4 py-2 text-gray-800 dark:text-gray-200">NO</td>
                <td class="border border-slate-700 px-4 py-2 text-gray-800 dark:text-gray-200">
                    <x-dark-link-button route="{{ $client->id }}" text="{{ __('Edit') }}"></x-dark-link-button>
{{--                    <a--}}
{{--                            href="{{ $client->id }}"--}}
{{--                            class="rounded-md px-3 py-2 dark:bg-gray-700 dark:hover:bg-gray-300 mr-2"--}}
{{--                    >--}}
{{--                        {{ __('Edit') }}--}}
{{--                    class="rounded-md px-3 py-2 dark:bg-red-500/20"--}}
{{--                    </a>--}}
                    <a
                            href="{{ $client->id }}"
                            class="inline-flex items-center px-4 py-2 bg-white dark:bg-red-500/20 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-red-500 dark:hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
                    >
                        {{ __('Delete') }}
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
