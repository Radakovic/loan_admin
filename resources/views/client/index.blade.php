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
                    <a
                            href="#"
                            class="rounded-md px-3 py-2 dark:bg-gray-700 dark:hover:bg-gray-300 mr-2 text-gray-800 dark:text-gray-200"
                    >
                        {{ __('Create client') }}
                    </a>
                </div>
            </div>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
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
                                    <a
                                            href="{{ $client->id }}"
                                            class="rounded-md px-3 py-2 dark:bg-gray-700 dark:hover:bg-gray-300 mr-2"
                                    >
                                        {{ __('Edit') }}
                                    </a>
                                    <a
                                            href="{{ $client->id }}"
                                            class="rounded-md px-3 py-2 dark:bg-red-500/20"
                                    >
                                        {{ __('Delete') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
